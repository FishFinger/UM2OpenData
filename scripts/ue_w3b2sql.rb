# -*- coding: utf-8 -*-
require 'text'

def proximity(a, b)
  a = a.downcase
  b = b.downcase
  Text::Levenshtein.distance(a,b) / ((a.size() + b.size())/2.0)
end

def coefficient(a, b, threshold = 0)
   
  a = a.split(' ')
  b = b.split(' ')

  intersection = Array.new
  union = Array.new

  a.each do |e1|
    union.push(e1)

    b.each do |e2|
      if proximity(e1,e2) <= threshold
        intersection.push(e1)
        b.delete(e2)
        break;
      end
    end
  end

  b.each do |e2|
    union.push(e2)
  end
 
  return intersection.length.to_f / union.length.to_f
end

  STATE_INIT = 0 # initial state, @deprecated, warning unused
  STATE_BEGIN = 1 # wait an person description
  STATE_CODE = 2 # wait the lastname
  STATE_ID = 3 # ...
  STATE_LIB = 4
  STATE_ECTS = 5
  STATE_RESPONSABLE_HEADER = 6
  STATE_RESPONSABLE = 7
  STATE_OTHER_RESPONSABLE = 8
  
  TAB = {}

  state = STATE_INIT;
  inib = false;
  def init()
    @state = STATE_CODE 
  end

  def line(text)
	  
    case @state
    when STATE_CODE
	  if(text.length < 10)
		code(text);
		@state = STATE_ID
	  end	
    when STATE_ID
      @state = STATE_LIB
    when STATE_LIB
      lib(text)
      @state = STATE_ECTS
    when STATE_ECTS
      @state = STATE_RESPONSABLE_HEADER
    when STATE_RESPONSABLE_HEADER
      @state = STATE_RESPONSABLE
    when STATE_RESPONSABLE
      responsable(text)
	  @state = STATE_OTHER_RESPONSABLE
    when STATE_OTHER_RESPONSABLE
      if(!text.match(/^\t/))
		@state = STATE_CODE
		line(text)
	  end

    end
  end


  def code(attr)
	traitement_string(attr)
	if(TAB[attr])
		@inib = true
	else
		@inib = false
		TAB[attr] = true
	end

    puts "( '#{attr}', " unless @inib
  end
  
  def lib(attr)
    traitement_string(attr)
    puts "'#{attr}' , " unless @inib
  end
  
  def responsable(attr)
   traitement_string(attr)
   if(!@inib)
	   found = false
		PERSON_DIR.each do | key, value |
		  if  coefficient(key,attr,0.3) >= 0.8
			puts "'#{value}' ), " 
			found = true
			break;
		  end
		end

		if !found
		  puts "NULL ),"
		end
	end	
  end

  def traitement_string(s)
  
	s.strip!()
	s.gsub!(/['"\\\x0]/,'\\\\\0')
  end


#########################################################################$
# MAIN

PERSON_DIR = {}
open("../res/Personne.csv") do |f|
  f.each_line do |l|
    tab = l.split(';')
    tab[0].gsub!(/(^")|("$)/,'')
    tab[1].gsub!(/(^")|("$)/,'')
    tab[2].gsub!(/(^")|("$)/,'')
    PERSON_DIR[tab[1]+' '+tab[2]] = tab[0]
  end
end


puts "INSERT INTO Course (
`id` ,
`libelle`,
`managed_by`
)
VALUES 
" 

init();

open("../res/ue_w3b.txt") do |f|
  f.each_line do |l|
    line(l);
  end
end

