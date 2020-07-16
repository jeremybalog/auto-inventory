<?php

namespace App\Models;

use App\Kernel\ViewController;

class Car
{
    private $sql;
    protected $table = "cars";
    protected $cols = [
        'id',
        'year',
        'model',
        'make',
        'condition',
        'mileage',
        'stock_number',
        'vin',
        'props',
    ];
    public $perPage = 9;

    function __construct($arr = [])
    {
        $sql = include __DIR__."/../Services/Sql.php";
        $sql->select_db("dealer");
        $this->sql = $sql;

        foreach($this->cols as $col) {
            if (!empty($arr[$col])) {
                if ($col === 'props' && !is_array($arr[$col])) {
                    $this->props = json_decode($arr[$col], true);
                } else {
                    $this->$col = $arr[$col];
                }
            }
        }
    }

    public function save()
    {
        $cols = [];
        $values = [];
        foreach ($this->cols as $col) {
            if (!empty($this->$col)) {
                $cols[] = "`".$col."`";
                if ($col === 'props') {
                    $values[] = "'".(json_encode($this->props))."'";
                } else {
                    $values[] = "\"".addslashes($this->$col)."\"";
                }
            }
        }

        $colCsv = implode(',', $cols);
        $updates = [];
        foreach($cols as $key => $value) {
            $updates[] = "{$cols[$key]}={$values[$key]}";
        }
        $updateCsv = implode(',', $updates);
        $valueCsv = implode(',', $values);

        $query = "INSERT INTO {$this->table} ({$colCsv}) VALUES (".$valueCsv.") ON DUPLICATE KEY UPDATE {$updateCsv}";
        $this->sql->query($query);
    }

    private function colTerms($cols = [])
    {
        $magicQuoteCols = [];
        foreach($this->cols as $col) {
            $magicQuoteCols[] = "`".$col."`";
        }
        return implode(',', $magicQuoteCols);
    }

    private function whereTerms($params = [])
    {
        $wheres = [];
        foreach($this->cols as $col) {
            if (!empty($params[$col])) {
                $wheres[] = "`$col`=\"{$params[$col]}\"";
            }
        }

        if (!empty($wheres)) {
            return " WHERE ".implode(' AND ', $wheres);
        } else {
            return '';
        }
    }

    public function search($params = [])
    {
        $colCsv = $this->colTerms($this->cols);

        $query = "SELECT {$colCsv} FROM {$this->table} ";
        $query .= $this->whereTerms($params);

        if (!empty($params['page'])) {
            $offset = ($params['page'] - 1) * $this->perPage;
            $query .= " LIMIT {$offset},{$this->perPage};";
        } else {
            $query .= " LIMIT {$this->perPage};";
        }

        return $this->sql->query($query);
    }

    public function searchCount($params = [])
    {
        $wheres = $this->whereTerms($params);
        $result = $this->sql->query("SELECT COUNT(*) count FROM cars {$wheres}");

        return $result->fetch_row()[0];
    }

    public function searchFacets($params = [])
    {
        $wheres = $this->whereTerms($params);

        $facets = [
          'make',
          'model',
          'condition',
          'year'
        ];

        $options = [];

        foreach ($facets as $facet) {
            $query = "SELECT COUNT(*) count,`{$facet}` FROM cars {$wheres} GROUP BY `{$facet}` ORDER BY COUNT(*) DESC,`{$facet}` ASC;";
            $results = $this->sql->query($query);
            $options[$facet] = [];
            while ($row = $results->fetch_assoc()) {
                $options[$facet][] = $row;
            }
        }

        return $options;
    }

    public function searchSimilar($params = [])
    {
        extract($params);
        $colCsv = $colCsv = $this->colTerms($this->cols);
        $query = "SELECT {$colCsv} FROM cars WHERE make=\"{$make}\" AND model=\"{$model}\" AND id!={$id} LIMIT 3;";

        return $this->sql->query($query);
    }

    public function title()
    {
        return "{$this->year} {$this->make} {$this->model}";
    }

    public function slug()
    {
        return "/".preg_replace("#\s+#i", '-', $this->title())."-for-sale-{$this->id}";
    }

    public function svg()
    {
        return preg_replace('#<g>\s*<path #i', "<path style=\"fill: {$this->props['color']};\"", file_get_contents(dirname(__FILE__)."/../../public/img/car-{$this->props['image']}.svg"));
    }

    public function renderTile()
    {
        $this->title = $this->title();
        $this->slug = $this->slug();
        $this->svg = $this->svg();

        return ViewController::renderView('partials/vdpTile', $this);
    }
}

?>
