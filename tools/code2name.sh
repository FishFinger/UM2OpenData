#!/bin/sh

cat $1 | sed 's#\(\S*\)\s\([^(]*\)\s(\([0-9]*\).*#UesMatching.ues.put("\1","\2");\nUesMatching.ects.put("\1","\3");#'
