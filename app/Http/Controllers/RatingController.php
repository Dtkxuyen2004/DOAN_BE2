<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerRating;

class RatingController extends Controller
{
    public function index()
    {
        $ratings = CustomerRating::orderBy('created_at', 'desc')->get();
        return view('ratings.index', compact('ratings'));
    }
}
