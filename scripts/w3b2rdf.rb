# -*- coding: utf-8 -*-
require 'rexml/document'
require 'rexml/streamlistener'
require 'open-uri'
require 'text'
require 'jaccard'

include REXML

DEBUG = true

#def proximity(a, b)
#  a = a.downcase
#  b = b.downcase
#  Text::Levenshtein.distance(a,b) / ((a.size() + b.size())/2.0)
#end

#def coefficient(a, b, threshold = 0)
   
#  a = a.split(' ')
#  b = b.split(' ')

#  intersection = Array.new
#  union = Array.new

#  a.each do |e1|
#    union.push(e1)

#    b.each do |e2|
#      if proximity(e1,e2) <= threshold
#        intersection.push(e1)
#        b.delete(e2)
#        break;
#      end
#   end
#  end

#  b.each do |e2|
#    union.push(e2)
#  end
 
#  return intersection.length.to_f / union.length.to_f
#end


class Ue
  
  def initialize
    @id = ""
    @code = ""
    @lib = ""
    @ects = ""
    @description = ""
    @responsible = Array.new  
  end

  ###################################
  # SETTERS

  def set_id(id)
    id.sub!(/id_/,"")
    @id = id
    open(W3B_URI_BASE + "run?method=w2display&uid=" + @id){ |f|
        
      f.each_line { |l|
        t = l.scan(/<span>(.*)<\/span>/)
        if !t.empty?()
          if !t[0].empty?()
            if t[0][0].empty?()
              break
            end
          
          set_responsible(t[0][0])
          #puts "[" << t[0][0].to_s() << "]"
        
          end
        end
        
      }
    }
  end

  def set_code(code)
    @code = code
  end
  
  def set_lib(lib)
    @lib = lib
  end
  
  def set_ects(ects)
    @ects = ects
  end

  def set_responsible(responsible)
    found = false
#    /*LIRMM_DIR.each do | key, value |
#      if coefficient(key,responsible,0.2) == 1.0
#        @responsible.push(value)
#        found = true
#        break;
#      end
#    end*/

    if !found
      @responsible.push(responsible)
    end
    
    
  end

  ####################################
  # METHODS

  def set_lib_and_ects(txt)
    set_lib(/(.*)/.match(txt)[1])
    set_ects(/\((.*) ECTS\)/.match(txt)[1])
  end

  def print()
    puts @code
    puts @id
    puts @lib
    puts @ects
    
    puts "responsable :"
    @responsible.each { |r|
      puts "\t" << r
    }  
  end
end

class Listener
  include StreamListener

  STATE_INIT = 0 # initial state, @deprecated, warning unused
  STATE_BEGIN = 1 # wait an person description
  STATE_ID = 2 # wait the lastname
  STATE_CODE = 3 # ...
  STATE_LIB = 4
  STATE_ECTS = 5
 

  def initialize()
    @state = STATE_INIT 
  end

  def tag_start(name, attr)
    case @state
    when STATE_INIT 
      if name == "h3" and attr['class'] == "title"
        @state = STATE_ID
      end
    when STATE_ID 
      if name == "a"
        @ue = Ue.new
        @ue.set_id(attr['id'])
        @state = STATE_CODE
      end
    when STATE_ID 
      if name == "span"
        @state = STATE_CODE
      end
    end
  end

  def text(text)
    text.sub!(/(&nbsp;)+/, "")
    text.strip!()
    return if text.empty?

    case @state
    when STATE_CODE
      @ue.set_code(text)
      @state = STATE_LIB
    when STATE_LIB
      @ue.set_lib_and_ects(text)
      @ue.print()
      @state = STATE_ID
    end
  end

  def tag_end(name)
   
  end

end


#########################################################################$
# MAIN

LIRMM_DIR = {}
open("../res/lirmm_dir_0.1.csv") do |f|
  f.each_line do |l|
    tab = l.split(';')
    LIRMM_DIR[tab[0]] = tab[1]
  end
end

#LIRMM_DIR.each do | key, value |
#  puts "[" << key << "] = " << value
#end 


W3B_URI_BASE = "http://w3b.info-ufr.univ-montp2.fr/siufr/"
W3B_URI = W3B_URI_BASE + "run?method=w2listUeBySemester&uid=322e39fbeb6bf9dd61954e480c9b82007582e9bed1da8cfa78c8eccc3b9fc00083e0477c4e45e02e&annee=2012"

open(W3B_URI){|f|
  listener = Listener.new
  parser = Parsers::StreamParser.new(f, listener)
  begin
    parser.parse
  rescue => detail
    print "some errors were occured" if DEBUG
    print detail.backtrace.join("\n") if DEBUG
  end
  }

