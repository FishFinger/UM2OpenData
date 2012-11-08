#!/bin/sh

cat ../res/ue_w3b.txt | grep -E ^s | grep -v http:// | sort | uniq | sed 's@\s*\(\S\+\s\+\(\S*[a-z]\+\S*\s\+\)*\)\([^a-z]\+\S[^a-z]*\)@INSERT INTO person (`firstname`, `lastname`) VALUES (\1,  \3);@'
