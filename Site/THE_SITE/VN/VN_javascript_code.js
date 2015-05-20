
	window.addEventListener("keydown", function(e) {
		// space and arrow keys
		if([32, 37, 39].indexOf(e.keyCode) > -1) {
			e.preventDefault();
		}
	}, false);
	var b=0;
	var i=0;
	var muscic_count=0;
	var continue_from_checkpoint=0;
	var continue_from_checkpoint2=0;
	var counter=0;
	var previous_clicked=0;
	var sound_or_not=0;
	var is_video=0;
	var text="";
	var choices="";
	var temp="";
	var buffer="";
	var previous_song1="";
	var choices_made=1;	//used for the previous
	var choices_made2="";//used for tracking the next part after an option is presented
	var music_vol=100;
	var sound_vol=100;
	function checkKey(e) {
		var event = window.event ? window.event : e;
		if (true) {
			alert(event.keyCode)
		}
	}
	document.onkeydown = checkKey;

	function checkKey(e) {

		e = e || window.event;

		if (e.keyCode == '38') {
			//i=i+1;
			//document.getElementById("image").innerHTML = "up";
		}
		else if (e.keyCode == '40') {
			//i=i-1;
			//document.getElementById("image").innerHTML = "down";
		}
		else if ((e.keyCode == '37') && (i != 0)){
			Previous();
			//document.getElementById("image").innerHTML = "left";
		}
		else if (e.keyCode == '39') {
			Next();
			//document.getElementById("image").innerHTML = "right";
		}
	}
	
menu();
function ended_video(){
	is_video=0;
	butts();
	Next();
}
function Next() {
	if ((is_video==1) && (previous_clicked==0)){
		return;
	}else if(is_video==1)
		ended_video();
	if (pictures[i] == "}"){
		return;
	}
	temp = document.getElementById("options").innerHTML;
	if (temp != ""){
		return;
	}
	i++;
	if((i==1)){
		Starts();
	}
	if ((previous_clicked>0) || ((choices_made>1) && (i<=choices_made))){
		previous_clicked--;
	}
	texts();
	print();
}
function Previous(){
	if ((is_video==1) && (previous_clicked==0)){
		return;
	}else if(is_video==1) {
		is_video=0;
		butts();
	}
	if (i>1){
		i=i-1;
		if ((choices_made>1) && (i<choices_made)){
			i=choices_made;
			texts();
			print();
			return;
		}
		previous_clicked++;
		texts();
		print();
	}else{
		previous_clicked++;
		menu();
	}
}
function print(){
	temp=pictures[i-1];
	if (temp.substring(0,2)=="#{"){
		resources();
	}
	if (is_video == 0)
		pic="<img src=\"resources/"+temp+"\">";
	else{
		pic= '<video onended="ended_video()" autoplay> <source src="resources/'+temp+'" type="video/mp4"></video>';
		//is_video=0;
		video_works();
	}
	document.getElementById("image").innerHTML = pic;
	Choice();
}
function resources(){
		buffer="";
		for (muscic_count=2;muscic_count<=temp.length;muscic_count++){
			if (temp[muscic_count] == "}"){
				temp = temp.substr(muscic_count+1);
				return;
			}
			if (buffer=="music:"){
				buffer="";
				for (muscic_count;muscic_count<=temp.length;muscic_count++){
					if (temp[muscic_count]==";"){
						//previous_song2=previous_song1;
						previous_song1=buffer;
						Musics(buffer,0);
						buffer="";
						break;
					}
					//buffer=buffer.substr(muscic_count-2);
					buffer=buffer+temp[muscic_count];
				}
			}
			else if (buffer=="sound:"){
				buffer="";
				for (muscic_count;muscic_count<=temp.length;muscic_count++){
					if (temp[muscic_count]==";"){
						//previous_song2=previous_song1;
						Musics(buffer,1);
						buffer="";
						break;
					}
					//buffer=buffer.substr(muscic_count-2);
					buffer=buffer+temp[muscic_count];
				}
			}
			else if(buffer=="video"){
				is_video=1;
			}
			if (temp[muscic_count] != ";"){
				buffer=buffer+temp[muscic_count];
			}
		}
}
function texts(){
	
	//setTimeout()  
	text="<div id=\"texts\">";
	if (previous_clicked>0){
		text=text+"<span id=\"texts_span2\"><br>";
	}else
		text=text+"<span id=\"texts_span\"><br>";
	text=text+talk[i-1]; //talk[0]
	text=text+"</span></div>";
	document.getElementById("text-box").innerHTML = text;
}
function Choice(){
	if (choicesz[i] != "")
	{
		text="";
		var array = choicesz[i].split("\t");
		for (val of array){
			text=text+'<button id ="Choice" onclick=\'chisen_path(\"'+val+'\")\'>';
			text=text+val;
			text=text+"</button>";
			document.getElementById("options").innerHTML = text;
		}
		text="";
	}else{
		document.getElementById("options").innerHTML = "";
	}
}
function Musics(text,sound_or_not){
	//NHK_-_Purupuru_pururin_rin.mp3
	//
	if(((text=="none")||(text=="")) && (sound_or_not==0)){
		document.getElementById("music").innerHTML = "";
	}else if (sound_or_not==0){
		text='<audio id="music_in" src="resources/'+text+'" loop="true" autoplay></audio>';
		document.getElementById("music").innerHTML = text;
		document.getElementById('music_in').volume = music_vol/100;
	}else{
		text='<audio id="sound_in" src="resources/'+text+'" autoplay></audio>';
		document.getElementById("sound").innerHTML = text;
		document.getElementById('sound_in').volume = sound_vol/100;
	}
	text="";
}
function video_works(){
	var video = document.getElementsByTagName('video');
	texts();
	//console.log (video);
	//document.getElementById("text-box").innerHTML = "";
	//document.getElementById("buttons").innerHTML = "";
}
function chisen_path(choices_made2){
	counter=0;
	for(b=i;b<pictures.length;b++){
		if (pictures[b].indexOf("{") > -1){
			counter++;
		}
		if (pictures[b].indexOf("}") > -1){
			counter--;
		}
		if ((pictures[b]==choices_made2+"{") && (counter==1)){
			i+=2;
			texts();
			print();
			choices_made=i;
			break;
		}else{
			i++;
		}
	}
}
function showValue(newValue,sound_or_not)
{
	if (sound_or_not==0){
		document.getElementById("range").innerHTML=newValue*100;
		music_vol=newValue*100;
	}else if (sound_or_not==1){
		document.getElementById("range2").innerHTML=newValue*100;
		sound_vol=newValue*100;
	}
}
function Options(){
	temp=document.getElementById("settings").innerHTML;
	if (temp == ""){
		text="<div id=\"Options\">";
		text=text+"<span>";
		text=text+'MUSIC: <input type="range" min="0" max="1" value="'+music_vol/100+'" step="0.1" onchange="showValue(this.value,0)" /> <span id="range">'+music_vol+'</span>';
		text=text+'<br>';
		text=text+'SOUND: <input type="range" min="0" max="1" value="'+sound_vol/100+'" step="0.1" onchange="showValue(this.value,1)" /> <span id="range2">'+sound_vol+'</span>';
		text=text+"</span>";
		text=text+"<span>"+
		"</span>";
		text=text+"</div>";
		document.getElementById("settings").innerHTML = text;
	}else{
		remuve_options();
	}
}
function Continue(){
	if (continue_from_checkpoint2 != 0){
		document.getElementById("options").innerHTML = "";
		i=continue_from_checkpoint2;
		butts();
		print();
		texts();
		Musics(previous_song1,0);
		remuve_options();
		//previous_clicked-=1;
	}else if (i==0){
		if (previous_clicked != 0){
			i=previous_clicked-1;
		}
		previous_clicked=0;
		butts();
		Next();
	}
}
function Starts(){
	i=1;
	//previous_clicked=0;
	print();
	texts();
	butts();
	remuve_options();
	//Save();
}
function remuve_options(){
	document.getElementById("settings").innerHTML = "";
}
function return_to_menu() {
	continue_from_checkpoint2=i;
	menu();
	//document.getElementById("image").innerHTML = "<img src=\"Pictures/"+i+".png\">";
	//text();
}
function butts(){
		text="<button id=\"butts\" onclick=\"Next()\" style=\"margin-left:780px; border-top-left-radius: 20px; border:0px;\">Next</button>";
		text=text+"<button id=\"butts\" onclick=\"Previous()\" style=\"margin-right:0px; border:0px;\">Previous</button>";
		text=text+"<button id=\"butts\" onclick=\"return_to_menu()\" style=\"margin-right:0px; border:0px;\">Menu</button>";
		document.getElementById("buttons").innerHTML = text;
}
function menu(){
		//previous_clicked++;
		Musics("none",0);
		text="";
		text=text+"<button id=\"Menu\" onclick=\"Starts()\" style=\"bottom:620px; color: white;\">Start</button>";
		text=text+"<button id=\"Menu\" onclick=\"Continue()\" style=\"bottom:320px; color: white;\">Continue</button>";
		text=text+"<button id=\"Menu\" onclick=\"Options()\" style=\"bottom:20px; color: white;\">Options</button>";
		document.getElementById("buttons").innerHTML = text;
		document.getElementById("image").innerHTML = '<img id=\"menu_image\" src = "resources/index.jpg"></img>';
		document.getElementById("text-box").innerHTML = '';
		document.getElementById("settings").innerHTML = '';
		document.getElementById("options").innerHTML = '';
		i=0;
}
/*
	RULES WHEN WRING A MANUSCRIPT
	1. Must have a '\t before the text/each of the buttons'
	2. If you want a '\t' as dialogue you have to write \t
	3. Resources must be specified before the image
	4. All videos/cut scenes have to be in an mp4 format
	5. 
	
	RESOURCES
	
	music:;
	sound:;
	video;
	
	Syntax
	
	#{resources}pic	text	button_name1	button_name2
	button_name1{
	stuff
	}
	button_name2{
	stuff
	}
	
	!!!No tabs before the resources/image!!!
*/

/*
	Need to implement features(for the resources)
	
	- in case of a chosen option go back to a specific scene.
	- when going back, go to the last choice you made(has to be specified as a resources option).
	- sounds for when he goes to the next/previous scene / when you click on an option.
	
	Need to implement features
	
	- when ctrl is pressed a skip button shows up.
	- auto button(goes to the next scene after a period of time).
	- auto forward time(the time he has input in seconds(do it with either a slider or that word thing with the font size)).
	- text speed.
	- save slots.
	- load and save buttons .
	- animations for when he loads from a save file.
	- begin skipping button(goes trough the scenes very quickly, until the next choices appear).
	- when loading ask the user if he is sure, because he will loose his progress.
	- help button at the menu(maybe).
	- in case of a gif for a transition get the time of the gif (so it plays once)
	- get the music to not stop after going backwards.(has to be specified as a recouse)
	- menu music
	- another text file with the stuff for the menu-for the makers of the games
	
	Check if it works
	
	- in case of a gif for an image (if it repeats)
	
	xml http request AJAX
	
	HTTP stuff
	
	get 
	post 
	put 
	delete
	
	PHP cake framework
	Python Ojengo framework
	Ruby Rails framework
	
	research frameworks MVC MVP
*/
