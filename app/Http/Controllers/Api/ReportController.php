<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Report;
class ReportController extends Controller
{



    public function getReport(){


      $report = Report::all();

      $kttCount = Report::where('ktt', '<>', '')->get()->count();

      $nizzCount =   Report::where('nizz', '<>', '')->get()->count();

      $tmgCount =  Report::where('tmg', '<>', '')->get()->count();

      $noUnitCount =  Report::where('noUnit', '<>', '')->get()->count();

      return response()->json(['report' => $report, 'kttCount' => $kttCount, 'nizzCount' => $nizzCount, 'tmgCount' => $tmgCount, 'noUnitCount' => $noUnitCount]);

    }


    public function editItem(Request $request){

      $validator = \Validator::make($request->all(), [

        'cubeNumber' => 'required',
        'phoneModel' => 'required',
        'teacher' => 'required',
        'id' => 'required'

      ]);

      if ($validator->fails()) {
         return response()->json($validator->errors(), 422);
      }



        $editedItem = Report::findorFail($request->id);

        $editedItem->cubeNumber = $request->cubeNumber;
        $editedItem->phoneModel = $request->phoneModel;

        $editedItem->ktt = $request->ktt;
        $editedItem->nizz = $request->nizz;
        $editedItem->tmg = $request->tmg;
        $editedItem->noUnit = $request->noUnit === 'true' ? 'no unit' : '';

        if($request->ktt === null){

            $editedItem->ktt = '';


        }

        if($request->nizz === null){

            $editedItem->nizz = '';
        }

        if($request->tmg === null){

          $editedItem->tmg = '';
        }



        $editedItem->teacher = $request->teacher;

        $editedItem->save();

        $kttCount = Report::where('ktt', '<>', '')->get()->count();

        $nizzCount =   Report::where('nizz', '<>', '')->get()->count();

        $tmgCount =  Report::where('tmg', '<>', '')->get()->count();

        $noUnitCount = Report::where('noUnit', '<>', '')->get()->count();

        $report = Report::all();

      return response()->json(['report' => $report, 'kttCount' => $kttCount, 'nizzCount' => $nizzCount, 'tmgCount' => $tmgCount, 'noUnitCount' => $noUnitCount]);


    }



    public function createItem(Request $request){

      $validator = \Validator::make($request->all(), [

        'cubeNumber' => 'required',
        'phoneModel' => 'required',
        'teacher' => 'required'

      ]);

      if ($validator->fails()) {
         return response()->json($validator->errors(), 422);
      }


      $editedItem = new Report;
      $editedItem->cubeNumber = $request->cubeNumber;
      $editedItem->phoneModel = $request->phoneModel;

      $editedItem->ktt = $request->ktt;
      $editedItem->nizz = $request->nizz;
      $editedItem->tmg = $request->tmg;
      $editedItem->noUnit = $request->noUnit === 'true' ? 'no unit' : '';

      if($request->ktt === null){

          $editedItem->ktt = '';


      }

      if($request->nizz === null){

          $editedItem->nizz = '';
      }

      if($request->tmg === null){

        $editedItem->tmg = '';
      }



      $editedItem->teacher = $request->teacher;

      $editedItem->save();

      $kttCount = Report::where('ktt', '<>', '')->get()->count();

      $nizzCount =   Report::where('nizz', '<>', '')->get()->count();

      $tmgCount =  Report::where('tmg', '<>', '')->get()->count();

      $noUnitCount =  Report::where('noUnit', '<>', '')->get()->count();



    return response()->json(['success' => true, 'kttCount' => $kttCount, 'nizzCount' => $nizzCount, 'tmgCount' => $tmgCount, 'noUnitCount' => $noUnitCount, 'newItem' => $editedItem]);




    }


    public function deleteItem(Request $request){

      $validator = \Validator::make($request->all(), [

        'id' => 'required'


      ]);

      if ($validator->fails()) {
         return response()->json($validator->errors(), 422);
      }



      $deleteItem = Report::find($request->id)->delete();

      $kttCount = Report::where('ktt', '<>', '')->get()->count();

      $nizzCount =   Report::where('nizz', '<>', '')->get()->count();

      $tmgCount =  Report::where('tmg', '<>', '')->get()->count();

      $noUnitCount =  Report::where('noUnit', '<>', '')->get()->count();



    return response()->json(['success' => true, 'kttCount' => $kttCount, 'nizzCount' => $nizzCount, 'tmgCount' => $tmgCount, 'noUnitCount' => $noUnitCount]);
    }






}
