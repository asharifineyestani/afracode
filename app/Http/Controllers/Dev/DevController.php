<?php

namespace App\Http\Controllers\Dev;

use App\Http\Controllers\Controller;
use App\Rules\MediaPath;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DevController extends Controller
{

//"resource" => new UserResource($this->user),
//"collection" => RoleCollection::collection($this->roles)

    public $columns;

    /**
     * @param Request $request
     * @param $table
     * @param null $type
     * @return mixed
     *
     * regex_resource
     * from: \"(.*)\",
     * to:   "$1" => \$this->$1,
     */

    /**
     * regex Input:
     * from: Input::get\(\'(.*?)\'\)
     * to:   \$request->('$1')
     */


    public function getTableColumns(Request $request, $table, $type = null)
    {
        $this->columns = DB::getSchemaBuilder()->getColumnListing($table);


        switch ($type) {
            case "fillable":
                return $this->getFillable();
                break;
            default:
                return $this->columns;
        }

        // OR

        return Schema::getColumnListing($table);
    }

    /**
     * @param Request $request
     * @return array
     *
     * regex
     * from:    ,
     * to:      => 'required|',
     */
    public function getKeys(Request $request): array
    {
        return $request->keys();
    }


    public function rules(): array
    {
        $method = $this->method();

        switch ($method) {
            case 'POST':
            {
                return [
                    'name' => 'required | string',
                    'gender' => 'required | in:NOT-SELECTED,MALE,FEMALE',

                    "role" => 'required|in:CANDIDATE,EMPLOYER',
                    "username" => [
                        'required',
                        'string',
                        'max:255',
                        'unique:users',
                        'alpha_dash'
                    ],
                    'password' => [
                        'required',
                        'min:6',
                        'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[!$#%]).*$/',
                        'confirmed'
                    ],
                    "email" => [
                        'required',
                        'email',
                        'unique:users'
                    ],
                    "tag" => [
                        'required',
                        'string',
                    ],
                    "phone" => [
                        'required',
                        'regex:/[0-9]{10}/'
                    ],
                ];
            }
            case 'PUT':
            {
                return [
                    'name' => 'required | string',
//                        'gender' => 'required | in:NOT-SELECTED,MALE,FEMALE',
                    'avatar_path' => 'string', new MediaPath()
                ];
            }


            default:
                break;
        }
    }


    public function uploadVideo($originalMedia): string
    {
        $extension = $originalMedia->getClientOriginalExtension();
        $name = '_' . time() . '.' . $extension;
        $path = public_path();
        $originalMedia->move($path, $name);

        return $this->pathMedia . $name;
    }

    public function store(Request $request): array
    {
        return $request->all();
    }

    private function getFillable()
    {
        $columns = $this->columns;
        $diff = array_diff($columns, ["id", "created_at", "updated_at"]);
        $values = array_values($diff);
        echo 'protected $fillable = ';
        $this->print_array($values);
    }

    private function print_array($array, $end = true)
    {
        echo '[';
        echo "\n";
        foreach ($array as $key => $value) {
            echo '"';
            echo $value;
            echo '",';
            echo "\n";
        }
        echo ']';

        if ($end)
            echo ";";
    }


    public function ip(): array
    {

        $data['ip'] = \Request::ip();
        return $data;
    }


    public function getTables()
    {
        $list = [];
        $tables = DB::select('SHOW TABLES');
        $key = 'Tables_in_' . env('DB_DATABASE');
        foreach ($tables as $table){
            echo '<a href="/api/dev/columns/'.$table->$key.'">' . $table->$key . '</a>';
            echo '</br>';
        }



    }


    public function getTableٰ2(): array
    {
        $list = [];
        $tables = DB::select('SHOW TABLES');
        $key = 'Tables_in_' . env('DB_DATABASE');
        foreach ($tables as $table)
            $list[] = $table->$key;
        return $list;
    }

}
