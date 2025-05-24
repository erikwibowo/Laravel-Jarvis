<?php

namespace App\Console\Commands;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Throwable;
use function Termwind\{render};

class Jarvis extends Command
{
    /**
     * signature naming.
     */
    protected $signature = 'jarvis:generate {name : The name of the resource} {--p|page : Generate only Vue page}';

    /**
     * signature description.
     */
    protected $description = 'Generate all resource model app and route => Controller, Model, Migration, Request, Route, Page. use option -p or --page to generate only vue page';

    /**
     * running commands
     */
    public function handle(): int
    {
        try {
            $name = ucfirst($this->argument('name'));

            // === only generate vue page using param --p or --page===
            if ($this->option('page')) {
                $this->makeDir(resource_path("/js/Pages/$name"));

                render(view('cli.pages', [
                    'pageIndex' => $this->pageIndex($name),
                    'pageForm' => $this->pageForm($name),
                ]));

                return self::SUCCESS;
            }

            // === Creating Resources ===
            $this->makeDir(resource_path("/js/Pages/$name"));
            $this->makeDir(app_path("/Http/Requests/$name"));
            $this->makeDir(base_path("/routes/jarvis"));

            // === creating special route for resource ===
            File::append(
                base_path('routes/jarvis.php'),
                "require __DIR__.'/jarvis/".strtolower($name).".php';\n"
            );

            // === creating permission CRUD ===
            foreach (['delete', 'update', 'read', 'create'] as $action) {
                Permission::create([
                    'name' => strtolower($name) . " $action",
                    'guard_name' => 'web'
                ]);
            }

            // === giving access to superadmin ===
            $superadmin = Role::where(['name' => 'superadmin'])->first();
            $superadmin->givePermissionTo([
                strtolower($name).' delete',
                strtolower($name).' update',
                strtolower($name).' read',
                strtolower($name).' create',
            ]);

            // === generate complete resource ===
            render(view('cli.jarvis', [
                'controller' => $this->controller($name),
                'model' => $this->model($name),
                'migration' => $this->migration($name),
                'storeRequest' => $this->storeRequest($name),
                'updateRequest' => $this->updateRequest($name),
                'pageIndex' => $this->pageIndex($name),
                'pageForm' => $this->pageForm($name),
                'permission' => strtolower($name) . " permission",
                'route' => $this->route($name)
            ]));

            return self::SUCCESS;
        } catch (Throwable $th) {
            // === catching error ===
            $this->error("Terjadi kesalahan: " . $th->getMessage());
            return self::FAILURE;
        }
    }

    // === Generate Controller from stub ===
    protected function controller($name): string
    {
        $params = $this->replaceStub('Controller', $name);
        file_put_contents(app_path("/Http/Controllers/{$name}Controller.php"), $params, LOCK_EX);
        return "app/Http/Controllers/{$name}Controller.php";
    }

    // === Generate Model from stub ===
    protected function model($name): string
    {
        $params = $this->replaceStub('Model', $name);
        file_put_contents(app_path("/Models/$name.php"), $params, LOCK_EX);
        return "app/Models/$name.php";
    }

    // === Generate Migration with timestamp from stub ===
    public function migration($name): string
    {
        $path = "/migrations/" . date('Y_m_d_His_') . "create_" . strtolower(Str::plural($name)) . "_table.php";
        $params = $this->replaceStub('Migration', $name);
        file_put_contents(database_path($path), $params, LOCK_EX);
        return "database/" . $path;
    }

    // === Generate Form Request for Store from stub ===
    public function storeRequest($name): string
    {
        $path = "/Http/Requests/$name/{$name}StoreRequest.php";
        $params = $this->replaceStub('Requests/Store', $name);
        file_put_contents(app_path($path), $params, LOCK_EX);
        return "app" . $path;
    }

    // === Generate Form Request for Update from stub ===
    public function updateRequest($name): string
    {
        $path = "/Http/Requests/$name/{$name}UpdateRequest.php";
        $params = $this->replaceStub('Requests/Update', $name);
        file_put_contents(app_path($path), $params, LOCK_EX);
        return "app" . $path;
    }

    // === Generate File Index.vue from stub ===
    public function pageIndex($name): string
    {
        $path = "/js/Pages/$name/Index.vue";
        $params = $this->replaceStub('Pages/Index', $name);
        file_put_contents(resource_path($path), $params, LOCK_EX);
        return "resources" . $path;
    }

    // === Generate File Form.vue from stub ===
    public function pageForm($name): string
    {
        $path = "/js/Pages/$name/$name" . "Form.vue";
        $params = $this->replaceStub('Pages/Form', $name);
        file_put_contents(resource_path($path), $params, LOCK_EX);
        return "resources" . $path;
    }

    // === Generate File Route for this resource from stub ===
    public function route($name): string
    {
        $path = "/routes/jarvis/" . strtolower($name) . ".php";
        $params = $this->replaceStub('Route', $name);
        file_put_contents(base_path($path), $params, LOCK_EX);
        return "app" . $path;
    }

    // === replacing stub with the current name ===
    protected function replaceStub($stubName, $name): string
    {
        $stub = file_get_contents(resource_path("stubs/$stubName.stub"));

        return str_replace(
            [
                '{{modelName}}',
                '{{modelNameLowerCase}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNamePlural}}'
            ],
            [
                $name,
                strtolower($name),
                strtolower(Str::plural($name)),
                Str::plural($name)
            ],
            $stub
        );
    }

    // === create directory if not exist ===
    protected function makeDir($path): bool
    {
        return is_dir($path) || mkdir($path, 0777, true);
    }
}
