<?php

namespace App\Repositories;

use Illuminate\Container\Container as Application;



abstract class DBBaseRepository
{
    /**
     * @var Builder
     */
    protected $table;

    /**
     * @var Application
     */
    protected $app;
    protected $query;
    /**
     * @param Application $app
     *
     * 
     */
    public function __construct(Application $app)
    {
        $this->app = $app;

        $this->setTable();
        $this->query = $this->table;
    }

    /**
     * Get searchable fields array
     *
     * @return array
     */
    abstract public function getFieldsSearchable();

    /**
     * Configure the table
     *
     * @return string
     */
    abstract public function table();

    /**
     * Make table instance
     *
     * 
     *
     * @return Builder
     */
    public function setTable()
    {
        $table = \DB::table($this->table());


        return $this->table = $table;
    }

    /**
     * Paginate records for scaffold.
     *
     * @param int $perPage
     * @param array $columns
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($perPage, $columns = ['*'])
    {
        $query = $this->allQuery();

        return $query->paginate($perPage, $columns);
    }

    /**
     * Build a query for retrieving all records.
     *
     * @param array $search
     * @param int|null $skip
     * @param int|null $limit
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function allQuery($search = [], $skip = null, $limit = null)
    {
        $this->query = $this->table;

        if (count($search)) {

            $this->query->where(function ($query) use ($search) {
                foreach ($search as $key => $value) {
                    if (in_array($key, $this->getFieldsSearchable())) {
                        $query->orWhere($key,"LIKE","%{$value}%");
                    }
                }
            });
        }

        if (!is_null($skip)) {
            $this->query->skip($skip);
        }

        if (!is_null($limit)) {
            $this->query->limit($limit);
        }

        return $this->query;
    }

    /**
     * Retrieve all records with given filter criteria
     *
     * @param array $search
     * @param int|null $skip
     * @param int|null $limit
     * @param array $columns
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all($search = [], $skip = null, $limit = null, $columns = ['*'])
    {
        $this->query = $this->allQuery($search, $skip, $limit);

        return $this->query->query->get($columns);
    }

    /**
     * Create table record
     *
     * @param array $input
     *
     * @return Builder
     */
    public function create($input)
    {
        unset($input["_token"]);
        unset($input["_method"]);
        $table = $this->table->insertGetId($input);


        return $table;
    }

    /**
     * Find table record for given id
     *
     * @param int $id
     * @param array $columns
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|table|null
     */
    public function find($id, $columns = ['*'])
    {
        $query = $this->table;

        return $query->find($id, $columns);
    }

    /**
     * Update table record for given id
     *
     * @param array $input
     * @param int $id
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|table
     */
    public function update($input, $id)
    {
        unset($input["_method"]);
        unset($input["_token"]);
        $query = $this->table->where("id",$id);

        

    

     

        return   $query->update($input);;
    }
    public function query()
    {
        return $this->query;
    }
    /**
     * @param int $id
     *
     * @throws \Exception
     *
     * @return bool|mixed|null
     */
    public function delete($id)
    {
        $query = $this->table->where("id",$id);

     

        return $query->delete();
    }
}
