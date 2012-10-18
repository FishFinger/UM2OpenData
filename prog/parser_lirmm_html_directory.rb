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
    puts "\n<rdf:Description rdf:about='#{uri}'>"
    puts "\t<rdf:type rdf:resource='foaf:Person' />"
    puts "\t<rdfs:isDefinedBy rdf:resource='#{LIRMM_DIR_URI}' />"
  end

  def lastname(attr)
    puts "\t<foaf:lastName>#{attr}</foaf:lastName>"
  end
  
  def firstname(attr)
    puts "\t<foaf:firstName>#{attr}</foaf:firstName>"
  end

  def phone(attr)
    puts "\t<foaf:phone>#{attr}</foaf:phone>"
  end

  def desk(attr)
    #puts "<desk>#{attr}</desk>"
  end
 
  def email(attr)
    puts "\t<foaf:mbox>#{attr}</foaf:mbox>"
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
    puts "</rdf:Description>"
  end
end


#########################################################################$
# MAIN

LIRMM_DIR_URI = "http://localhost/UM2opendata/lirmm_dir_0.2.rdf#"

puts "<rdf:RDF
  xmlns:rdf='http://www.w3.org/1999/02/22-rdf-syntax-ns#'
  xmlns:rdfs='http://www.w3.org/2000/01/rdf-schema#'
  xmlns:foaf='http://xmlns.com/foaf/0.1/'
  xmlns:lirmm_dir='#{LIRMM_DIR_URI}'
>
" 

listener = Listener.new
parser = Parsers::StreamParser.new(File.new("../res/annuaire_lirmm.html"), listener)
parser.parse

puts "</rdf:RDF>"
