<?php
/*This fills $GLOBALS arrays with datas from ids in stock/
Default values, less specialized, are in: skeleton/default/[_datas, _models]
-stock:/
	-201404030948000000/												Uid of an object, time based, date hour ms.
		-_data/
			icon.png
			title.txt
			type.txt
		-_as__askedPage/
			_data/
				chapters/
				gallery/
				intro/
				.../
		Loops are possible:
			-xDirName/
				01_fileName.txt
				01_fileValue.txt
				02_fileName.txt
				02_fileValue.txt
		Loops in the html:
			-___xDirName__BlockStart___
				___xDirName__LoopStart___
					___xDirName__fileName___
					___xDirName__fileValue___
				___xDirName__LoopStop___
			-___xDirName__BlockStop___
			or:
			______xDirNameStart___  ______xDirName___  ______xDirNameStop___
*/



#This version do not use occurence from file to determine the path of the item,
#it takes directly a path from the tree dir, sent as html argument: &path=/id__200100000000000000/content/classement__1__id__200100000000000000
class metaList{
	function __construct($path, $debugFlag=false){
		#Avoid names resolution conflict
		$this->path=$path;
		#One flag because i'm tired of testing for it:
		if($this->path == $GLOBALS['urlParams']['path']){ $this->isAskedItem=true;}
		else{ $this->isAskedItem=false;}

		#Datas dirs names we want to scan. those have to exists as: stock/id/_dirName or anywhere deeper in the dir tree, but always prefixed with an _.
		$this->dataSrc[]='data';
		$this->dataSrc[]='model';
		if($this->isAskedItem){ $this->dataSrc[]='as__askedPage';}
		#Initialize the properties for those datas dirs as array.
		foreach($this->dataSrc as $srcName){$this->$srcName=array();}

		#Another small help
		$this->pathLastPart=fs::pathLastPart($this->path);
		#Get container too
		$this->container=basename(preg_replace('~'.preg_quote(DIRECTORY_SEPARATOR.fs::pathLastPart($this->path)).'$~','',$this->path));
		#get info from $path, either id only or: /id__200100000000000000/rank__000000001__id__200200000000000000
		$dirNameArr= fs::dirNameInfos($path);
		if(!$dirNameArr){return false;}
		#and add them to the object.
		foreach($dirNameArr as $key => $value){ $this->data[$key]=$value; }
		#Must have, i'm tired to fight to do without
		$this->id=$this->data['id'];

		#Check if datas have been already launched in global scope
		$this->alreadyDone=false;
		if($this->container!='' && is_array($GLOBALS['itemsData'][$this->container])){$this->alreadyDone = iAlreadyExists($this->id, $GLOBALS['itemsData'][$this->container]);}
		if($this->alreadyDone!=false){return false;}
		#Add path arg to the item's datas
		$this->data['path']=$this->path;

		#Initialize others stuff.
		#ancestors are added to globals[itemsdata][navigation] if we treat the askedpage.
		$this->data['lineage']= getAncestorsTypes($this->path);

		#Set exclude words arr for path finding in lineage
		$this->excludeFromSearch= array();
		if($this->isAskedItem==false){$this->excludeFromSearch[]='_as__askedPage';}
		#get the datas values
		$itemPath = $GLOBALS['PATHS']['stock'].DIRECTORY_SEPARATOR.$this->data['id'].DIRECTORY_SEPARATOR;

		foreach($this->dataSrc as $srcName){ $this->lineage('_'.$srcName, $itemPath, $this->$srcName, $this->excludeFromSearch); }
		#get and merge with skeleton values (normally news values overwrites olds, but here we only want to fill missing things)
		#first those from /skel/itemType(rubrique, article..) and then those from /skel/default
		$skeletonPath = $GLOBALS['PATHS']['skeleton'].DIRECTORY_SEPARATOR.$this->data['type'].DIRECTORY_SEPARATOR;
		$this->microSkelFunc($skeletonPath);
		if($this->data['type'] != 'site'){
			$skeletonPath = $GLOBALS['PATHS']['skeletonDefault'].DIRECTORY_SEPARATOR;
			$this->microSkelFunc($skeletonPath);
		}

		#Case item is the asked one, overwrite values once again with datas from _as__askedPage dirs:
		if( $this->isAskedItem && (count($this->as__askedPage)>0) ){
			foreach($this->dataSrc as $srcName){
				if(array_key_exists('_'.$srcName, $this->as__askedPage)){ $this->$srcName= array_replace_recursive($this->$srcName, $this->as__askedPage['_'.$srcName]); }
			}
		}
		unset ($this->as__askedPage);

		#Fill and repack the html model as a one block with it's children.
		if(count($this->model)>1){
			$modelChildrenArr = $this->model;
			unset($modelChildrenArr['model']);
			$arr['dataArr']=$modelChildrenArr;
			$arr['modelStr']= $this->model['model'];
			$this->model['model']=replacementMotor($arr);
		}

		#Create a html link property.
		#Only if there is none already found in one of the data dirs (case for external link).
		if (!array_key_exists('htmlLink', $this->data)){ $this->data['htmlLink']=$GLOBALS['PATHS']['httpMotorIndex'].htmlGetParamsRebuild($this->data); }

		#add data to navigation array if needed.
		if($this->isAskedItem==true){ 
			$GLOBALS['itemsData']['navigation'][$this->id]=$this->properties();
			$GLOBALS['itemsData']['navigation'][$this->id]['model']['model']=$GLOBALS['itemsData']['navigation'][$this->id]['model']['navigation'];
		}
	}
	#END of the class constructor

	function properties(){
		$result=array();
		foreach ($this->dataSrc as $key => $value) { $result[$value]=$this->$value; }
		return $result;
	}

	#loads values from $skelPath, merge loosely with object values ($skelPath values are overwritten by existing ones).
	function microSkelFunc($skelPath){
		foreach($this->dataSrc as $srcName){
			$skelArr = array();//$this->property[$srcName];
			$this->lineage('_'.$srcName, $skelPath, $skelArr, $this->excludeFromSearch);
			//$this->property[$srcName] = array_merge($skelArr, $this->property[$srcName]);
			$this->$srcName = array_replace_recursive($skelArr, $this->$srcName);
		}
	}

	



	#Find, score and hostile merge found datas
	#Args:
	#	$targetDirName 		: '_data'	The name of the directories from which we wants datas to be retrieved and merged.
	#	$path 			: '/stock/id'	One path where to look for dirs with $targetDirName name, either stock/ or skeleton/.
	# 	$originalDatasArr 	: this datas 	Pointer to actuals datas we want to update.
	#	$excludeArr		: ['word1', 'wordX'] 	remove path wich contains those words
	function lineage($targetDirName, $argPath, &$originalDatasArr, $excludeArr){
		#get less specialized datas: (/stock/anId/_[data|model]), this permit to have some default values loaded.
		getAndMerge($argPath.$targetDirName, $originalDatasArr);
		#Build lineage, the array from path of specifications to look for.
		#Chech if lineage has already been built.
		

		#Genetics enter the show!
		#Find the most accurate datas, those from closest dir in the obj/_[data | model |...]/.../ than the one from lineage (parents specifications).
		#Ranking paths and related datas then apply everything from least to most accurate path.
		#Values "default" (the less specialized) datas in /stock/id/_[data | model...] have already been merged at the begining of lineage function.
		#Exists $GLOBALS['dataRoutingPrefix'] array in /conf/dataRoutingPrefix
		$scoredArrOfDirs = array();
		if( ($arrOfDirs = fs::dirTreeByName($argPath, $targetDirName, $excludeArr))!==false){
			#get/overwrite values of right software or other kind of leading names in the path if exists
			#one more deep level if path contain "as__askedPage" and item is the asked one.
			($this->isAskedItem)? $oneMore=1:$oneMore=0;
			#one more deep level for the trailing /_targetDirName
			$oneMore++;

			foreach ($arrOfDirs as $dir) {
				#Flag for unwanted dirs, those with wrong things like wrong software or display values
				$flagBadDir=false;

				#remove unneeded part
				$dirCleaned = preg_replace('~'.preg_quote($argPath).'~', '', $dir);
				#split by directory
				$arrDirMembers = explode(DIRECTORY_SEPARATOR, $dirCleaned);
				# Skip counting process if only _data or something like is present (already launched).
				if(count($arrDirMembers)==1){continue;}
				#stop if dir is deeper than occurence+others (too specialized)
				$isDeep = count($arrDirMembers);
				$maxDeep= count($GLOBALS['dataRoutingPrefix']) + count($this->data['lineage']) + $oneMore;
				if( $isDeep > $maxDeep){continue;}
				#look how many consecutive match in data routing land.
				#and if it goes to default values or not
				#point priority + point parentType + point containerType + point exactitude finale par rapport au lineage + point routing
				#priority: 0 for default path, 1 for normal path, 2 for asked page
				$tmpArr = array();
				$tmpArr['path']=$dir;
				$tmpArr['priorityScore']='';
				$tmpArr['parentTypeScore']='';
				$tmpArr['containerTypeScore']='';
				$tmpArr['lineageExactitudeScore']='';
				$tmpArr['dataRoutingScore']='0';
				$tmpArr['finalScore']='';
				$isDefault=false;
				$isAskedPage=false;
				$c=0;

				#Check the beginning of the path for routing words and if they're default ones.
				foreach ($GLOBALS['dataRoutingPrefix'] as $value) {
					#Routing can be (or not present at all) only asked ones or default ones, others values have to be excluded

					#for software__xyz, display__xyz, ...
//					$strToLook1		='~^'.$value.'__'.$GLOBALS['askedPage'][$value].'$~';		//display__flat
//					$strToLook2		='~^'.$value.'__'.$GLOBALS['GET'][$value.'ByDefault'].'$~';	//display__default
//					$tmpIsARouting		= preg_match($strToLook1, $arrDirMembers[$c]);
//					$tmpIsADefaultRouting	= preg_match($strToLook2, $arrDirMembers[$c]);
//					if( ($tmpIsARouting==1) || ($tmpIsADefaultRouting==1) ){
					$strToLook1= $value.'__'.$GLOBALS['urlParams'][$value]; 	//display__flat
					$strToLook2= $value.'__'.$GLOBALS['GET'][$value.'ByDefault']; 	//display__default
					if( $strToLook1 == $arrDirMembers[$c] ){ 			//It's a routing, and the asked value
						$tmpArr['dataRoutingScore']++;
						$c++;
					}
					elseif ($strToLook2 == $arrDirMembers[$c] ) { 			//It's a routing, and the default value
						$tmpArr['dataRoutingScore']++;
						$c++;
						$isDefault=true;
					}
					elseif (preg_match('~'.$value.'__~', $arrDirMembers[$c])) { 	//It's a routing, but a wrong one, exclude it.
						$flagBadDir=true;
						break;
					}
					else{break;} 							//It's not a routing
				}
				if($flagBadDir){continue;}

				#same for lineage land, except matching will count starting at the end of the path.
				#counters: -1 to match array indexes, -1 more to skip the last index (_data or whatever _name).
				#Lineage counter, supposed to be perfect.
				$cLineageMembers = count($this->data['lineage'])-1;
				#Dirs from data path, supposed to be far from perfect.
				$cDataPathMembers = count($arrDirMembers)-1-1;
				# askded page hack, "forgot" the last path part '_as__askedPage', when needed.
				if($arrDirMembers[$cDataPathMembers]=='_as__askedPage'){
					if($this->isAskedItem){
						$isAskedPage=true;
						$cDataPathMembers--;
					}
				}


				$flagExactitude = true;
				#Loop through data path until we meet routing dirs.
				for($i=$cDataPathMembers; $i>$tmpArr['dataRoutingScore']; $i--){
					#Part of path can be container or parentType
					$tmpIsAContainer = ($arrDirMembers[$i]=='in__'.$this->data['lineage'][$cLineageMembers])? 1:0;
					$tmpIsParentType = ($arrDirMembers[$i-1]=='in__'.$this->data['lineage'][$cLineageMembers-1])? 1:0;
					#No container, only parent type
					$tmpIsParentTypeMissingContainer = ($arrDirMembers[$i]=='in__'.$this->data['lineage'][$cLineageMembers-1])? 1:0;

					#Perfect case: lineage: rubrique/content 	path: in__rubrique/in__content
					if($tmpIsAContainer==1){
						if($flagExactitude==true){$tmpArr['lineageExactitudeScore']++;}
						$tmpArr['containerTypeScore']++;
						$cLineageMembers--;
						if($tmpIsParentType==1){
							if($flagExactitude==true){$tmpArr['lineageExactitudeScore']++;}
							$tmpArr['parentTypeScore']++;
							$i--;
							$cLineageMembers--;
						}
						#Wrong parent type, exit.
						else{
							$flagBadDir=true;
							break;
						}
					}
					#Missing container case: lineage: rubrique/content 	path: in__rubrique/--
					elseif($tmpIsParentTypeMissingContainer==1){
						$flagExactitude=false;
						$tmpArr['parentTypeScore']++;
						$cLineageMembers-=1;
					}

					else{
						$flagBadDir=true;
						break;
					}
				}
				if($flagBadDir){continue;}

				#set priority score.
				$bitDefault=0;
				$bitAskedPage=0;

				($isDefault != false)? $bitDefault=0: $bitDefault=1;
				($isAskedPage != false)? $bitAskedPage=1: $bitAskedPage=0;
				$tmpArr['priorityScore']=$bitAskedPage.$bitDefault;

				#Cat results as a long number, 'normally', higher the better.
				$scoreFieldLength=3;
				$tmpArr['finalScore']=
					''.addLeadingZeros($tmpArr['priorityScore'], $scoreFieldLength)
					.'.'.addLeadingZeros($tmpArr['parentTypeScore'],$scoreFieldLength)
					.'.'.addLeadingZeros($tmpArr['containerTypeScore'],$scoreFieldLength)
					.'.'.addLeadingZeros($tmpArr['lineageExactitudeScore'],$scoreFieldLength)
					.'.'.addLeadingZeros($tmpArr['dataRoutingScore'],$scoreFieldLength);
				$scoredArrOfDirs[]=$tmpArr;
			}
		}

		#Sort results by finalScore
		$score=array();
		foreach ($scoredArrOfDirs as $key => $row) { $score[$key]  = $row['finalScore'];}
		array_multisort($score, SORT_ASC, $scoredArrOfDirs);

		foreach($scoredArrOfDirs as $dataDir){ getAndMerge($dataDir['path'], $originalDatasArr);}
	}
}
?>