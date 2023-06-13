#!/bin/bash
for (( i=70001 ; i<=71000 ; i++ ))
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
#	echo Permissions=HKC            >>$FileName
done
