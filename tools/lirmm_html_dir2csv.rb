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

    text.sub!(/(&nbsp;)+/, "")
    text.strip!()
    return if text.empty?

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
    @uri = uri
 
  end

  def lastname(attr)
   @lastname = attr
  end
  
  def firstname(attr)
    @firstname = attr
  end

  def phone(attr)

  end

  def desk(attr)

  end
 
  def email(attr)

  end

  def dept(attr)

  end

  def status(attr)

  end

  def tutelle(attr)

  end

  def end_entity()
    puts @firstname << " " << @lastname << ";" << @uri
  end
end


#########################################################################$
# MAIN

LIRMM_DIR_URI = "http://localhost/UM2opendata/lirmm_dir_0.2.rdf#"


listener = Listener.new
parser = Parsers::StreamParser.new(File.new("../res/annuaire_lirmm.html"), listener)
parser.parse


