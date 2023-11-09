<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use OpenAdmin\Admin\Admin;
use OpenAdmin\Admin\Controllers\Dashboard;
use OpenAdmin\Admin\Layout\Column;
use OpenAdmin\Admin\Layout\Content;
use OpenAdmin\Admin\Layout\Row;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->css_file(Admin::asset("open-admin/css/pages/dashboard.css"))
            ->title('Dashboard')
            ->row(function (Row $row) {

                $row->column(6, function (Column $column) {
                    $column->row('<h2>Annual Income</h2>')
                        ->row(view('admin.charts.income'));
                });

                $row->column(6, function (Column $column) {
                    $column->row('<h2>Annual Transactions</h2>')
                        ->row(view('admin.charts.transactions'));
                });

            })
            ->row(function (Row $row) {
                $row->column(6, function (Column $column) {
                    $column->row('<h2>Most Profitable City</h2>')
                        ->row(view('admin.charts.profit_city'));
                });

                $row->column(6, function (Column $column) {
                    $column->row('<h2>Annual Average Ratings</h2>')
                        ->row(view('admin.charts.ratings'));
                });
            });
    }
}
