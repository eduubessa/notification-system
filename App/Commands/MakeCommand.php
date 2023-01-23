<?php

namespace App\Commands;

class MakeCommand
{

    /**
     * @param string $arg
     */
    public function __construct(array $args)
    {
        switch ($args[1]) {
            case 'make:system':
                if(count($args) > 2) {
                    $this->notification($args[2]);
                } else {
                    echo "Please provide a name for the system";
                }
                break;
            case 'make:model':
                if(count($args) > 2) {
                    $this->model($args[2]);
                } else {
                    echo "Please provide a name for the model";
                }
                break;
        }
    }

    private function notification($arg): void
    {
        if(file_exists(__dir__ . '/../Notifications/' . $arg . '.php')) {
            echo "{$arg} already exists!";
            return;
        }

        $code = "<?php " . PHP_EOL . PHP_EOL;
        $code .= "namespace App\Notifications;" . PHP_EOL . PHP_EOL;
        $code .= "use App\Models\Notification;" . PHP_EOL . PHP_EOL;
        $code .= "class {$arg} extends Notification {" . PHP_EOL . PHP_EOL;
        $code .= " // Your code here" . PHP_EOL . PHP_EOL;
        $code .= "}" . PHP_EOL . PHP_EOL;

        file_put_contents(__dir__ . "/../Notifications/{$arg}.php", $code);

        print "\n \e[0;32m{$arg} system created successfully!\e[0m";
    }

    private function model($arg): void
    {
        if(file_exists(__dir__ . '/../Models/' . $arg . '.php')) {
            echo "{$arg} already exists!";
            return;
        }

        $code = "<?php " . PHP_EOL . PHP_EOL;
        $code .= "namespace App\Models;" . PHP_EOL . PHP_EOL;
        $code .= "use Illuminate\Database\Eloquent\Model;" . PHP_EOL . PHP_EOL;
        $code .= "class {$arg} extends Model {" . PHP_EOL . PHP_EOL;
        $code .= " // Your code here" . PHP_EOL . PHP_EOL;
        $code .= "}" . PHP_EOL . PHP_EOL;

        file_put_contents(__dir__ . "/../Models/{$arg}.php", $code);

        print "\n \e[0;32m{$arg} model created successfully!\e[0m";
    }
}