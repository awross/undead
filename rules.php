<?php
include('core/coreHead.php');

/*
if ($_SESSION['loggedin'] == 'true') {
	if ($_SESSION['rules'] == 0) {
		$content .= "
			<h2>YOU MUST AGREE TO THE RULES OF THIS ORGANIZATION IN ORDER TO USE THIS SITE</h2>
		";
	}
}
*/

$content .= "
</div> 
 
<div> 
 
  <p><font size='5' face='Verdana'><b>Overview</b></font></p> 
<p><font size='3' face='Verdana'>Humans Vs. Zombies is essentially a 
game of tag with two teams: Humans and Zombies. All players start off 
as humans, with the exception of a set number who have volunteered and 
are chosen to be Original Zombie(s). The Zombie(s) will start the 'infection' 
by tagging, or feeding on, members of the Human team. The Zombies must 
tag a Human at least once every three days, otherwise they 'starve 
out', and are then out of normal gameplay. (They may, however, return 
for missions and the final stand.) Humans may defend themselves from 
Zombies with approved equipment (listed below).</font> <br></p> 
<p><font size='3' face='Verdana'>The game will run from 12:00 AM to 
11:59:59 PM each day (24 hours) from the starting date to the posted 
ending time for the final stand.</font> <br></p> 
<p><font size='5' face='Verdana'><b>Objective</b></font></p> 
<p><font size='3' face='Verdana'>Zombie Objective: Turn all humans.</font></p> 
<p><font size='3' face='Verdana'>Human Objective: Survive the Zombie 
Apocalypse.</font> <br></p> 
<p><font size='5' face='Verdana'><b>Important!</b></font></p> 
<p><font size='3' face='Verdana'>The following rules and regulations 
have been created for the safety of everyone, all including players 
and non-players. These rules are strictly enforced. Violation of rules 
can and will result in a ban from the game and dealings with the proper 
authorities.</font> <br></p> 
<p><font size='5' face='Verdana'><b>Required Equipment</b></font></p> 
<p><font size='3' face='Verdana'>-<b>Current BG UNDEAD bandanna </b> 
(to be purchased by the player each year). This year's color is pink. 
Colors from previous years can be worn, but you are not considered in 
play without the current bandana.</font></p> 
<p><font size='3' face='Verdana'>-<b>Human Defensive Measures: </b> 
options are as follows (Humans can use any combination of these items):</font></p> 
<p>      <font size='3' face='Verdana'>+<b>Nerf 
Style Foam Blaster</b></font></p> 
<p>            <font size='3' face='Verdana'><b>-Must Remain Bright </b> 
and be <b>Non-Metallic Colors</b></font></p> 
<p>            <font size='3' face='Verdana'><b>-</b>Darts cannot be thrown by hand. They 
must be fired from a blaster or blowpipe.</font></p> 
<p>      <font size='3' face='Verdana'>+<b>PVC 
Blowpipe for soft-foam darts</b></font></p> 
<p>            <font size='3' face='Verdana'>-length <b>Only</b> up to 1 meter</font></p> 
<p>      <font size='3' face='Verdana'>+<b>Balled 
Up Socks</b> (to be thrown)</font></p> 
<p>            <font size='3' face='Verdana'>-Socks may be tapped or rubber-banded for stability</font></p> 
<p>            <font size='3' face='Verdana'>-Socks may have <b>Nothing</b> inside of them 
for weight/hardness/impact.</font></p> 
<p>            <font size='3' face='Verdana'>-<b>SOCKS MUST BE THROWN. THEY DO NOT STUN 
WHILE STILL IN HAND. </b>This means the sock and everything attached 
must leave the hand. If you attach a string to the sock to swing it 
around with, when you throw the sock, you cannot hold the swing to pull 
the sock back. The string has to leave your hand as well for the stun 
to count.</font></p> 
<p>      <font size='3' face='Verdana'>+<b>Standard 
size marshmallows </b>(to be thrown)</font></p> 
<p>            <font size='3' face='Verdana'>-No more than two marshmallows may be thrown 
from one hand at a time.</font></p> 
<p>            <font size='3' face='Verdana'>-Marshmallows must be thrown. They do not stun 
while still in hand.</font></p> 
<p>            <font size='3' face='Verdana'>-<b>No mini marshmallows. 
Period.</b></font></p> 
<p>      <font size='3' face='Verdana'><b>+Your 
ability to run away.</b></font></p> 
<p>      <font size='3' face='Verdana'><b>+ID 
Cards</b> -Cards must contain player name and ID and must be printed 
off the website (received when registering).</font></p> 
<p>      <font size='3' face='Verdana'>+Anything 
not specified above must be approved by an officer.</font> <br> 
</p> 
<p><font size='5' face='Verdana'><b>Safety Rules</b></font></p> 
<p><font size='3' face='Verdana'>-<b>No hand-to-hand combat is permitted.</b></font></p> 
<p><font size='3' face='Verdana'><b>-No melee weapons are permitted.</b></font></p> 
<p><font size='3' face='Verdana'><b>-No playing in safe zones.</b></font></p> 
<p>      <font size='3' face='Verdana'><b>-</b>The 
following areas are out of play 24/7:</font></p> 
<p>            <font size='3' face='Verdana'>+<b>Any staircase on campus is off-limits</b> 
as are the patios at the top of them. (For example: the patio on top 
of the Education Building is safe.) Patios below stairs, however, are 
in play. If you get confused, remember: top of stairs, out of play. 
Bottom of stairs, in play. <b>Exception to the rule: top of the library 
deck is in play.</b></font></p> 
<p>            <font size='3' face='Verdana'>+Loading docks</font></p> 
<p>            <font size='3' face='Verdana'>+Inside campus buildings</font></p> 
<p>            <font size='3' face='Verdana'>+Any class area</font></p> 
<p>            <font size='3' face='Verdana'>+Art building sculpture garden</font></p> 
<p>            <font size='3' face='Verdana'>+Vehicles (bikes, cars, buses, skateboards, 
rollerblades, anything on wheels)</font></p> 
<p>            <font size='3' face='Verdana'>+Within swing radius of ANY DOOR</font></p> 
<p>            <font size='3' face='Verdana'>+The bricks in front of the Union (This does 
not include the Union Oval.)</font></p> 
<p><font size='3' face='Verdana'>-You are only safe inside of safe zones. 
If you must resolve a debate during play, secure the area first or move 
to a safe zone. If you get tagged outside a safe zone while arguing 
about a tag, it is considered fair.</font></p> 
<p><font size='3' face='Verdana'>-<b>NO PLAYING OUT OF BOUNDS</b></font></p> 
<p>      <font size='3' face='Verdana'><b>-</b>Boundaries 
are the outer edge of sidewalks on: Wooster, Thurstin, Merry, and Mercer 
roads.</font></p> 
<p>      <font size='3' face='Verdana'>-Click 
here for a grid of the in-play area.</font></p> 
<p>      <font size='3' face='Verdana'>-Sidewalks 
of Wooster, Thurstin, Merry, and Mercer are in play, however the grassy 
areas between the sidewalks and the roads are safe zones. </font></p> 
<p>      <font size='3' face='Verdana'>-No 
tackling someone/running into the roads. Yes, a zombie might eat your 
figurative brain, but getting hit by an actual car will be far worse.</font></p> 
<p><font size='3' face='Verdana'>-No blocking doors or stairs.</font></p> 
<p><font size='3' face='Verdana'>-No shining flashlights in players' 
eyes.</font></p> 
<p>      <font size='3' face='Verdana'>-All 
flashlights <b>must</b> have a red filter.</font></p> 
<p><font size='3' face='Verdana'>-While on/in a vehicle, players are 
out of play (just like a stunned zombie) and must remove their bandana. 
Once the vehicle is out of motion, players may put their bandanas back 
on. They are then back in play.</font></p> 
<p><font size='3' face='Verdana'>Human Defensive Measures may <b>only</b> 
be those listed above unless specifically given permission by officers.</font></p> 
<p><font size='3' face='Verdana'>-<b>ABSOLUTELY, POSITIVELY NO PLAY 
IN THE GRAVEYARD.</b></font></p> 
<p><font size='3' face='Verdana'><b>-</b>Use common sense; if it looks 
like someone could get hurt, it's probably not a good idea.</font></p> 
<p><font size='3' face='Verdana'>-If you hear a whistle blown during 
a mission or at <b>any other time </b> 
during the game, this means 'time out.' You are to immediately stop 
what you are doing, freeze in your current location, and follow the 
moderator or medic's instructions.</font></p> 
<p><font size='3' face='Verdana'>-If you are confronted by the police, 
comply with them immediately. Keep your hands visible, tell them you're 
playing the 'zombie game,' and <b>under no circumstances reach 
for your nerf blaster</b>.</font></p> 
<p><font size='3' face='Verdana'>-Avoid interaction with non-players.</font></p> 
<p><font size='3' face='Verdana'>-If at any point during the game <b> 
anyone</b> complains that you are being disruptive, apologize and relocate 
immediately.</font></p> 
<p><font size='3' face='Verdana'>-Be considerate when indoors. Do not 
disrupt classes or res life.</font></p> 
<p><font size='3' face='Verdana'>-NO biting whatsoever.</font></p> 
<p><font size='3' face='Verdana'>-Seriously, <b>NO BITING WHATSOEVER.</b></font></p> 
<p><font size='3' face='Verdana'>-Do not leap off of buildings or decks. 
You can break bones that way. You know who you are.</font></p> 
<p><font size='3' face='Verdana'>-The administration has asked us to <b> 
stay out of trees. </b>Please respect that.</font> <br></p> 
<p><font size='5' face='Verdana'><b>Human Rules</b></font></p> 
<p><font size='3' face='Verdana'>-You must keep your ID Card on you 
at all times during the game.</font></p> 
<p><font size='3' face='Verdana'>-Humans <b>must</b> wear their bandana 
around their arm or leg, and it <b>must</b> be clearly visible at all 
times in-game. Your bandana may <b>not</b> be worn around the wrist, 
ankle or hand. The logo must be at least partially visible.</font></p> 
<p><font size='3' face='Verdana'>-Humans may (and probably should) stun 
Zombies for 10 minutes by utilizing foam darts, socks, or marshmallows.</font></p> 
<p><font size='3' face='Verdana'>-Humans can't stun Zombies from inside 
a safe zone. If you're trapped, find another exit or call for backup.</font></p> 
<p><font size='3' face='Verdana'>-Once tagged, the player <b>must</b> 
give up their ID card to the tagging Zombie and switch their bandana 
to the 'stunned' position. After 10 minutes, the player switches 
their bandana to their head, and thus becomes an infectious Zombie and 
may begin tagging Humans.</font> <br></p> 
<p><font size='5' face='Verdana'><b>Zombie Rules</b></font></p> 
<p><font size='3' face='Verdana'>-<b>Must 
'feed' by tagging a human at least once every 3 days, or Zombie 
will 'starve out' of normal gameplay.</b></font></p> 
<p>      <font size='3' face='Verdana'><b>-</b>When 
Zombies make a tag, they get 2 additional 'feedings' to distribute 
to other zombies.</font></p> 
<p><font size='3' face='Verdana'>-<b>Must wear bandana EASILY VISIBLE 
around their head, with the logo facing out. </b> 
Acceptable ZOMBIE ways to wear the bandana are:</font></p> 
<p>      <font size='3' face='Verdana'>-'Rambo' 
style headband</font></p> 
<p>      <font size='3' face='Verdana'>-Doo-rag 
style headwrap</font></p> 
<p><font size='3' face='Verdana'>-When in play, if bandana is voluntarily 
removed or moved to 'stunned' position, you must enter a building 
before bandana may be moved back to the head.</font></p> 
<p><font size='3' face='Verdana'>-To tag a human, Zombie must place 
one hand on each arm (the shoulder, and any area between the shoulder 
and right above the elbow) of the Human at the same time.</font></p> 
<p>      <font size='3' face='Verdana'>-Collect 
the Human's ID Card and report the tag on the website. <i>Tags must 
be reported </i><b><i>ASAP</i></b><i>, so that the new Zombie can hunt.</i></font></p> 
<p><font size='3' face='Verdana'><b>-</b>If a Zombie is hit with a foam 
dart, sock, or marshmallow, Zombies are 'stunned' for 10 minutes.</font></p> 
<p>      <font size='3' face='Verdana'>-Bandana 
must be switched to around the neck to show stunned status, and the 
Zombie must leave the immediate area. You must move your bandana to 
your neck if stunned. If you wear glasses and they get in the way, pull 
your glasses off first. If you have long hair and it gets caught in 
the bandana, untie the bandana. Yes, it's a pain. Deal with it.</font></p> 
<p>      <font size='3' face='Verdana'>-Stunned 
player may <b>NOT </b>touch or interact with the game, including: <i> 
shielding other zombies, chasing a human, or calling other zombies. 
Stunned zombies may still follow unstunned zombies so long as they do 
not interfere with gameplay.</i></font></p> 
<p>      <font size='3' face='Verdana'>-Zombies 
start with 10 stuns and lose 1 stun per day.</font></p> 
<p>      <font size='3' face='Verdana'>-If 
hit again while stunned, the 10 minutes is reset, but the Zombie does <b> 
not</b> lose another daily stun.</font></p> 
<p><font size='3' face='Verdana'>-Zombies may not block darts or shield 
themselves using held objects (ie: umbrella, backpack, etc.)</font></p> 
<p>      <font size='3' face='Verdana'>-Anything 
worn or carried counts as a stun.</font></p> 
<p>      <font size='3' face='Verdana'>-Zombies 
may (and probably should) run, dodge, duck, and hide behind stationary, 
grounded objects.</font></p> 
<p><font size='3' face='Verdana'>-Zombies must have both feet out of 
a safe zone to tag a human.</font></p> 
<p>      <font size='3' face='Verdana'>-No 
jumping or diving tags.</font> <br></p> 
<p><font size='5' face='Verdana'><b>OZ Rules</b></font></p> 
<p><font size='3' face='Verdana'>-You can volunteer to be an original 
zombie (OZ) by checking the box in your profile on the website.</font></p> 
<p><font size='3' face='Verdana'>-Original Zombie(s) are chosen by the 
Officers and Moderators. Chosen OZ's will be contacted the night before 
the start of the game.</font></p> 
<p><font size='3' face='Verdana'>-All Zombie rules apply to the OZ with 
the following exceptions:</font></p> 
<p>      <font size='3' face='Verdana'>-OZs 
are marked as humans and have unlimited stuns until they make 5 turns 
or until noon on the first day of the game (whichever comes first).</font></p> 
<p>      <font size='3' face='Verdana'>-OZs 
can be stunned while still marked as a human. Until the OZ is revealed, 
it is wise to stun any human you think might try to tag you.</font> <br> 
</p> 
<p><font size='5' face='Verdana'><b>Missions</b></font></p> 
<p><font size='3' face='Verdana'>-You will receive specific details 
before the mission. These details overrule anything below.</font></p> 
<p><font size='3' face='Verdana'>-There will be a mandatory mission 
briefing before each mission.</font></p> 
<p><font size='3' face='Verdana'>-During a mission, safe zones cannot 
be utilized.</font></p> 
<p>      <font size='3' face='Verdana'>-If 
you enter a safe zone or go out of bound during a mission, you are out 
of the mission. End of story.</font></p> 
<p><font size='3' face='Verdana'>-Amnesty (a time designating no Human 
vs. Zombie interaction) will be specified before each mission.</font></p> 
<p><font size='3' face='Verdana'>-Zombies have unlimited stuns during 
missions. Any stuns made during missions do not count toward the Zombie's 
daily stun count.</font></p> 
<p>      <font size='3' face='Verdana'>If 
a Zombie is stunned out or starved out of the game, </font></p> 
<p><font size='3' face='Verdana'>they may still play during the mission.</font> <br> 
</p> 
<p><font size='5' face='Verdana'><b>The Final Stand</b></font></p> 
<p><font size='3' face='Verdana'>-All rules applying to missions apply 
to the final stand.</font></p> 
<p><font size='3' face='Verdana'>-The final stand will occur on the 
last day of the game at a time posted by the Officers and Moderators.</font> <br> 
</p> 
<p><font size='5' face='Verdana'><b>Other Policies</b></font></p> 
<p><font size='3' face='Verdana'><b>The Leadership of BG UNDEAD and 
Player Moderators, chosen by the Leadership to act as Referee and Impartial 
Judge, have the final say in ALL disputes.</b></font></p> 
<p><font size='3' face='Verdana'><b>-</b>Any rules are subject to change 
during play by the officer corp. Any rule changes will be posted on 
the BG UNDEAD website and EMAILED out to all the players.</font> <br> 
</p> 
<p><font size='5' face='Verdana'><b>Final Word</b></font></p> 
<p><font size='3' face='Verdana'>-Abide by the DBAD policy (Don't 
Be A Dick): we all just want to have fun so obey the rules and use common 
sense. When registering on the website, you agreed to a waiver. This 
means we're not responsible for any lapse of common sense you may 
experience.</font></p> 
<p><font size='3' face='Verdana'>-Violators of the DBAD policy will 
be dealt with on a case by case basis. Each player can receive up to 
two DBAD strikes. The first strike is a warning. The second strike is 
removal from the game. Serious DBAD violators may end up dealing with 
University authorities.</font></p> 
<p><font size='3' face='Verdana'>-Examples of DBAD violations are as 
follows:</font></p> 
<p>      <font size='3' face='Verdana'><b>DON'T:</b></font></p> 
<p>            <font size='3' face='Verdana'>-fake an injury</font></p> 
<p>            <font size='3' face='Verdana'>-tackle people</font></p> 
<p>            <font size='3' face='Verdana'>-hide your bandana. Bandanas must be worn with 
360 degree visibility. A hat, hood, or your hair cannot be covering 
your bandana. Wear your bandana over these!</font></p> 
<p>            <font size='3' face='Verdana'>-Turn your bandana inside out or fold the bandana 
so the logo is not visible. The majority of the logo <b>must</b> be 
visible.</font></p> 
<p>            <font size='3' face='Verdana'>-Peek in windows while class is in session.</font></p> 
<p>            <font size='3' face='Verdana'>-Pick up darts that are not yours without the 
intent of immediately returning them</font></p> 
<p>            <font size='3' face='Verdana'>-Block doors</font></p> 
<p>            <font size='3' face='Verdana'>-Engage in any physical contact with other 
players beyond a zombie tagging someone</font></p> 
<p>            <font size='3' face='Verdana'>-Interfere with the game while stunned. </font></p> 
<p>            <font size='3' face='Verdana'>-Willfully injure another player</font></p> 
<p>            <font size='3' face='Verdana'>-Willfully or repeatedly break any rules</font></p> 
<p>            <font size='3' face='Verdana'>-Any action you or others feel is a dick move. 
(Hence the term 'DBAD.')</font></p> 
<p>      <font size='3' face='Verdana'><b>DO:</b></font></p> 
<p>            <font size='3' face='Verdana'>-Building hop</font></p> 
<p>            <font size='3' face='Verdana'>-Escape in vehicles</font></p> 
<p>            <font size='3' face='Verdana'>-Not play for a day (or more) if you are busy</font></p> 
<p>            <font size='3' face='Verdana'>-Not play due to classes</font></p> 
<p>            <font size='3' face='Verdana'>-Use your cell phone to call for backup. (Unless 
you are stunned. Then it is DBAD.)</font> <br></p> 
<p><font size='5' face='Verdana'><b>Questions</b></font></p> 
<p><font size='3' face='Verdana'>While the game is going on, you may 
direct questions or disputes about the rules to a Moderator or Officer, 
all of whom will be wearing red bandanas.</font></p> 
<p><font size='3' face='Verdana'>-For immediate concerns, you may contact 
an Officer or Moderator by phone (see the contacts page).</font></p> 
<p><font size='3' face='Verdana'>-You may also email the Officers at 
<a href='mailto:bgundead@gmail.com' target='_blank'>bgundead@gmail.com</a></font></p> 
 
 
</div> 
 
</div></body></html>
	
";

if ($_SESSION['loggedin'] == 'true') {
	if ($_SESSION['rules'] == 0) {
		$content .= "
			<br /><br /><br />
			<form action='setRules.php' method='post'>
			<input type='hidden' name='check' value='true' />
			<input type='submit' value='I Have Read All The Rules And I Agree To Abide By Them' />
			</form>	
		";
	}
}

include('core/coreFoot.php');
?>
