<?php
// globals
$GLOBALS['debug'] = true;
$GLOBALS['databaseUtility'] = new DatabaseUtility();

$GLOBALS['activity_type'][0] = "Wellbeing";
$GLOBALS['activity_type'][1] = "Awareness";
$GLOBALS['activity_type'][2] = "Ability";
$GLOBALS['activity_type'][3] = "Professionalism";
$GLOBALS['activity_type'][4] = "Work Ethic";

$GLOBALS['autonomy_support']['low'] = 0;
$GLOBALS['autonomy_support']['medium'] = 1;
$GLOBALS['autonomy_support']['high'] = 2;
$GLOBALS['competence_support']['low'] = 0;
$GLOBALS['competence_support']['medium'] = 1;
$GLOBALS['competence_support']['high'] = 2;
$GLOBALS['relatedness_support']['low'] = 0;
$GLOBALS['relatedness_support']['medium'] = 1;
$GLOBALS['relatedness_support']['high'] = 2;

$GLOBALS['player_choice_dilemma'] = 99;

// for ease of typing
$lowa = $GLOBALS['autonomy_support']['low'];
$meda = $GLOBALS['autonomy_support']['medium'];
$higha = $GLOBALS['autonomy_support']['high'];



// Home page strings
$GLOBALS["homestrings"]["Graduation"][$lowa] = "Countdown till the test:";
$GLOBALS["homestrings"]["Graduation"][$meda] = "Turns left:";
$GLOBALS["homestrings"]["Graduation"][$higha] = "Graduation:";

$GLOBALS["homestrings"]["Weekly Options"][$lowa] = "Required Tasks";
$GLOBALS["homestrings"]["Weekly Options"][$meda] = "Weeky Moves:";
$GLOBALS["homestrings"]["Weekly Options"][$higha] = "Weekly Options:";
 
$GLOBALS["homestrings"]["weekly_prompt"][$lowa] = "You must do both of these tasks weekly.";
$GLOBALS["homestrings"]["weekly_prompt"][$meda] = "These items are available once per week.";
$GLOBALS["homestrings"]["weekly_prompt"][$higha] = "How would you like to act over the next fortnight?";
 
$GLOBALS["homestrings"]["plan_activities"][$lowa] = "Spend your limited time.";
$GLOBALS["homestrings"]["plan_activities"][$meda] = "Activities";
$GLOBALS["homestrings"]["plan_activities"][$higha] = "Plan my week";
 
$GLOBALS["homestrings"]["plan_dilemmas"][$lowa] = "Make a difficult decision!";
$GLOBALS["homestrings"]["plan_dilemmas"][$meda] = "Dilemma!";
$GLOBALS["homestrings"]["plan_dilemmas"][$higha] = "Show your wisdom!";
 
$GLOBALS["homestrings"]["Daily_Options"][$lowa] = "Non-required Daily Tasks";
$GLOBALS["homestrings"]["Daily_Options"][$meda] = "Daily Moves";
$GLOBALS["homestrings"]["Daily_Options"][$higha] = "Daily Options";
 
$GLOBALS["homestrings"]["daily_prompt"][$lowa] = "You can do these daily.";
$GLOBALS["homestrings"]["daily_prompt"][$meda] = "Available each day.";
$GLOBALS["homestrings"]["daily_prompt"][$higha] = "Choose to put a little extra in.";
 
$GLOBALS["homestrings"]["plan_day"][$lowa] = "Today's Task";
$GLOBALS["homestrings"]["plan_day"][$meda] = "Daily Activity";
$GLOBALS["homestrings"]["plan_day"][$higha] = "Daily Opportunity";
 
// Weekly Planner Strings
$GLOBALS["weeklystrings"]["Title"][$lowa] = "You must pick tasks for the next fortnight.";
$GLOBALS["weeklystrings"]["Title"][$meda] = "Select Tasks:";
$GLOBALS["weeklystrings"]["Title"][$higha] = "How would you like to spend your time?";

$GLOBALS["weeklystrings"]["Instructions_beginning"][$lowa] = "You have ";
$GLOBALS["weeklystrings"]["Instructions_beginning"][$meda] = "You have ";
$GLOBALS["weeklystrings"]["Instructions_beginning"][$higha] = "Choose how you would like to spend your ";
$GLOBALS["weeklystrings"]["Instructions_end"][$lowa] = " time units you must spend.";
$GLOBALS["weeklystrings"]["Instructions_end"][$meda] = " time units to spend";
$GLOBALS["weeklystrings"]["Instructions_end"][$higha] = " time units.";

// Dilemma Page Strings
$GLOBALS["dilemmastrings"]["Title"][$lowa] = "You must choose how to respond.";
$GLOBALS["dilemmastrings"]["Title"][$meda] = "Answer Dilemma";
$GLOBALS["dilemmastrings"]["Title"][$higha] = "Weigh in with your opinion.";

$GLOBALS["dilemmastrings"]["placeholder"][$higha] = "Have a better idea?                                                                                                                           Tell us what you do and Careers Advisor Beverly Gardiner will give you your own unique score and feedback!";
$GLOBALS["dilemmastrings"]["placeholder"][$meda] = "Have a better idea?                                                                                                                           Tell us what you do and get your own unique score.";



 
?>