#!/bin/bash
for (( i=80002 ; i<=81000 ; i++ ))
# 16.12.2021.SR 80001 ist verloren gegangen lt. Fr. Kirberg
do
	export NUMBER=6$i
	export IDNumber=3140$NUMBER
	export FileName=Hammfelddamm/31406$i.dat
	echo $i, $NUMBER, $IDNumber, $FileName
	
	

	echo [PERSONAL]                 >$FileName
	echo UID=$IDNumber              >>$FileName
	echo PR_IDNummer=$IDNumber      >>$FileName
	echo PR_ModeZentrum=14          >>$FileName
	echo ShortName=HK D             >>$FileName
	echo Number=$NUMBER             >>$FileName
	echo PR_Personenkreis=7         >>$FileName
	echo CM_Gueltig=1121            >>$FileName
	echo GS=0                       >>$FileName
	echo LS=0                       >>$FileName
	echo Einzug=0                   >>$FileName
	echo [ACCESS]                   >>$FileName
#	echo Permissions=HKD            >>$FileName
done
