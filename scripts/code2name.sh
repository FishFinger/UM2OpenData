#!/bin/sh

cat $1 | grep -q  "([0-9.,]*\sECTS)" && sed 's#\(\S*\)\s\(.*\)\s\((\([0-9.,]*\)\sECTS)\).*#UesMatching.ues.put("\1","\2");\nUesMatching.ects.put("\1","\4");#' || sed 's#\([A-Z0-9]\{4,\}\)\s\(.*\).*#UesMatching.ues.put("\1","\2");#'
