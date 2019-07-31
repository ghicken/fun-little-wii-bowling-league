# fun-little-wii-bowling-league
<b>A PHP/MySQL Website for managing a Wii Bowling League</b>

<p>In December of 2017 I was asked to manage the stats for my community's Wii Bowling league in January. This code was written as quickly as possible and added to a shared-hosting website that has MySQL and PHP available. I added links to sections never completed, but it turned out the bowlers liked my weekly printouts better than going online. I added these files here to branch off my next version that will have improved code and some boilerplate JavaScript on top of a React template.</p>

<p>Bootstrap was used to make the website responsive. Most weeks I entered the numbers on my iPhone. Other than that, this is straight PHP, CSS and HTML. The Table design is as follows:</p>

<h4>admins</h4>
<p>userid varchar(8) not null primary key<br>
name varchar(100) not null<br>
password varchar(50) not null</p>

<h4>bowler</h4>
<p>bwlr_no smallint(8) not null primary key auto_increment<br>
lastname varchar(25) not null<br>
firstname varchar(25) not null<br>
tm_no tinyint(4)<br>
year_no tinyint(4)</p>

<h4>bwlr_week</h4>
<p>yr_wk_no smallint(8) not null<br>
bwlr_no smallint(8) not null<br>
raw_score int(11) not null<br>
avg int(11) not null<br>
hndcp int(11) not null<br>
score int(11) not null</p>

<h4>sub_week</h4>
<p>yr_wk_no smallint(8) not null<br>
absent_bwlr_no smallint(8) not null<br>
sub_bwlr_no smallint(8) not null</p>

<h4>team</h4>
<p>team_no tinyint(4) not null primary key auto_increment<br>
name varchar(30) not null<br>
year_no tinyint(4)</p>

<h4>tm_week</h4>
<p>tm_wk_no int(11) not null primary key auto_increment<br>
yr_wk_no smallint(8) not null<br>
tm_no smallint(8) not null<br>
bowl_order tinyint(5) not null</p>

<h4>week</h4>
<p>yr_wk_no smallint(8) not null primary key auto_increment<br>
year_no smallint(8) not null<br>
week varchar(2) not null</p>

<h4>year</h4>
<p>year_no tinyint(4) not null primary key auto_increment<br>
year varchar(4) not null</p>
