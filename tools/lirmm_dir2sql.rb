# -*- coding: utf-8 -*-
require 'rexml/document'
require 'rexml/streamlistener'
include REXML


class Listener
  include StreamListener

  STATE_INIT = 0 # initial state, @deprecated, warning unused
  STATE_BEGIN = 1 # wait an person description
  STATE_LASTNAME = 2 # wait the lastname
  STATE_FIRSTNAME = 3 # ...
  STATE_PHONE = 4
  STATE_DESK = 5
  STATE_EMAIL = 6
  STATE_DEPT = 7
  STATE_STATUS = 8
  STATE_TUTELLE = 9

  def initialize()
    @state = STATE_INIT 
    @inib = true # inibe l'intérprétation des zones de texte
  end

  def tag_start(name, attr)
    if name == "a" and attr['target'] == "_top"
      begin_entity(attr['href'])
      @state = STATE_LASTNAME
      @inib = false
    end
    if @state > STATE_BEGIN and name == "td" and attr['class'] == "td_annu"
      @state += 1
      @inib = false
    end
  end

  def text(text)
    return if @inib
    @inib = true;

    text.gsub!(/&nbsp;/, "")
    text.strip!()
    text.gsub!(/['"\\\x0]/,'\\\\\0')

    case @state
    when STATE_LASTNAME
      lastname(text)
    when STATE_FIRSTNAME
      firstname(text)
    when STATE_PHONE
      phone(text)
    when STATE_DESK
      desk(text)
    when STATE_EMAIL
      email(text)
    when STATE_DEPT
      dept(text)
    when STATE_STATUS
      status(text)
    when STATE_TUTELLE
      tutelle(text)
    end
  end

  def tag_end(name)
    if @state > STATE_BEGIN and name == "tr"
      end_entity()
      @state = STATE_BEGIN
    end
  end


  def begin_entity(uri)
    # traitement des références au dossier parent
    # /ruby/docs/../class => /ruby/class
    uri.sub!(/\/[^\/]+\/\.\.\//, "/") 
    puts "( '#{uri.hash.abs % 99999}', '#{uri}' ,  "
  end

  def lastname(attr)
    puts "'#{attr}', "
  end
  
  def firstname(attr)
    puts "'#{attr}' , "
  end

  def phone(attr)
    puts "'#{attr}' , "
  end

  def desk(attr)
    puts "'#{attr}', "
  end
 
  def email(attr)
    puts "'#{attr}' "
  end

  def dept(attr)
    #puts "<dept>#{attr}</dept>"
  end

  def status(attr)
    #puts "<status>#{attr}</status>"
  end

  def tutelle(attr)
    #puts "<tutelle>#{attr}</tutelle>"
  end

  def end_entity()
    puts "), "
  end
end


#########################################################################$
# MAIN

LIRMM_DIR_URI = "http://localhost/UM2opendata/lirmm_dir_0.2.rdf#"

puts "INSERT INTO Personne (
`id` ,
`describe`, 
`name` ,
`firstname` ,
`phone` ,
`office` ,
`mbox`
)
VALUES 
" 

listener = Listener.new
parser = Parsers::StreamParser.new(File.new("../res/annuaire_lirmm.html"), listener)
parser.parse

puts ";"
