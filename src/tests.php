<?php
class Tests
{
    /**
     * Tests collection
     *
     * @var array
     */
    private $tests = [];

    /**
     * Passed tests count
     *
     * @var int
     */
    private $passed = 0;

    /**
     * Failed tests count
     *
     * @var int
     */
    private $failed = 0;

    /**
     * Create a test
     *
     * @param $message
     * @param $callback bool|callback
     * @param $expected mixed
     *
     * @return mixed
     */
    public function is($message, $callback, $expected = null)
    {
        if ($callback && is_callable($callback)) {
            # If an assumtion is made, check if with the callback functions result
            # if not the function should be returning a bool result.
            $passed = is_null($expected) ? $callback() : $callback() == $expected;

            $this->tests[] = [
                'name' => $message,
                'passed' => $passed,
                'mark' => ($passed ? '✔︎' : '✘')
            ];
        } else {
            # $callback is alreay a bool result
            $this->tests[] = [
                'name' => $message,
                'passed' => $callback,
                'mark' => ($callback ? '✔︎' : '✘')
            ];
        }
    }

    /**
     * Reset counters
     *
     */
    public function reset()
    {
        $this->passed = 0;
        $this->failed = 0;
    }

    /**
     * Get passed tests count
     *
     * @return int
     */
    public function passed()
    {
        return $this->passed;
    }

    /**
     * Get failed tests count
     *
     * @return int
     */
    public function failed()
    {
        return $this->failed;
    }

    /**
     * Create a test report
     *
     * @return array
     */
    public function report()
    {
        // store tests and reset globals
        $tests = $this->tests;
        $this->tests = [];

        // iterate $tests and regroup into passed and failed
        $passed = [];
        $failed = [];
        foreach ($tests as $t) {
            if ($t['passed'] == true) {
                $passed[] = $t;
                $this->passed++;
            } else {
                $failed[] = $t;
                $this->failed++;
            }
        }

        return [
            'tests' => $tests,
            'passed' => $this->passed,
            'failed' => $this->failed
        ];
    }

}

# end of file: tests.php