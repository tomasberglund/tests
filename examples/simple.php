<?php
include __DIR__."/../src/tests.php";

$tests = new Tests();

$tests->is('first one', function() {
    return 1+1==3;
});

$tests->is('second one', function() {
    return 1+1==1;
});

$tests->is('third one', function() {
    return 1+1==2;
});

echo '<pre>';
foreach($tests->report()['tests'] as $tests) {
    echo $tests['mark'].' '.$tests['name'].'<br />';
}
echo '</pre>';

# end of file: simple.php