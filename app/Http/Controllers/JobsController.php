<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Models\Company;
use App\Models\FeaturedJob;
use App\Models\Jobs;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

use function PHPUnit\Framework\isEmpty;

class JobsController extends Controller
{
    /**
     * Display all jobs 
     * @param  
     * @return JSONResponse 
     */

    public function showJobs(Request $request)
    {
        try {
            // WHITELIST -  allowed fields for sorting 
            $allowedFields  = ['created_at', 'updated_at', 'title', 'deadline'];

            // validate and sanitize request params
            // default params 
            $sort_by = "created_at";
            $direction = "desc";

            // validate and sanitize sorting params

            // Check and set sort_by parameter
            if ($request->has('sortby') && in_array($request->input('sortby'), $allowedFields)) {
                $sort_by = $request->input('sortby');
            } else if ($request->has('sortby') && !in_array($request->input('sortby'), $allowedFields)) {
                return ResponseHelper::error(
                    message: 'Invalid sort param .',
                    statusCode: 400
                );
            }

            // Check and set direction parameter if provided and valid
            if ($request->has('direction')) {
                $inputDirection = $request->input('direction');
                if (in_array($inputDirection, ['asc', 'desc'])) {
                    $direction = $inputDirection;
                } else {
                    return ResponseHelper::error(
                        message: 'Invalid sort direction.',
                        statusCode: 400
                    );
                }
            }


            //Apply sorting logic - ASC Default is DESC 
            $jobs = Jobs::query()
                ->orderBy($sort_by, $direction)
                ->get();

            // if no jobs 

            if ($jobs->isEmpty()) {
                return ResponseHelper::error(
                    message: 'No Job listings Available!',
                    statusCode: 404,
                );
            }
            //asc order
            // $jobs = Jobs::orderBy('updated_at', 'asc')->get();
            // most added job
            // $latestJob = Jobs::latest()->first();

            // desc order
            // $jobs = Jobs::latest()->get();

            if ($jobs) {
                return ResponseHelper::success(message: 'success fetch of all Job listings', data: $jobs, statusCode: 200);
            }
            return ResponseHelper::error(message: 'Failled to display job listing. Please try again!',  statusCode: 400);
        } catch (Exception $e) {
            Log::error('Exception while displaying Job listings' . $e->getMessage() . ' - Line no. ' . $e->getLine());
            return ResponseHelper::error(message: 'Exception while displaying Job listings!',  statusCode: 500);
        }
    }

    /**
     * Filter job  listing criteria 
     * @param 
     * @return 
     * 
     */

    public function filterJobs(Request $request)
    {
        try {
            // WHITELIST allowed filters 
            $allowedFilters = ['schedule', 'status', 'location'];
            $requestFilters = $request->all();
        } catch (Exception $e) {
            Log::error('Exception while filtering Job listings' . $e->getMessage() . ' - Line no. ' . $e->getLine());
            return ResponseHelper::error(message: 'Exception while filtering Job listings!',  statusCode: 400);
        }
    }

    /**
     * Display a single job by id 
     *  @param Jobs_id
     *  @return JSONResponse
     */
    public function showSingleJob($jobs_id)
    {
        try {


            // Fetch the job associated with the given ID
            $job = Jobs::findOrFail($jobs_id);

            if ($job) {
                return ResponseHelper::success(message: 'Successfuly fetch job listing by ID', data: $job, statusCode: 200);
            }
            return ResponseHelper::error(message: 'Failed to fetch job by that ID', statusCode: 400);
        } catch (ModelNotFoundException $e) {
            // Handle the case where the job with given ID is not found
            return ResponseHelper::error(message: 'Job With that id does not exist | 404: ' . $jobs_id, statusCode: 404);
        } catch (Exception $e) {
            Log::error('Exception while fetching job by that ID!' . $e->getMessage() . ' - Line no. ' . $e->getLine());
            return ResponseHelper::error(message: 'Exception while fetching job by that ID!',  statusCode: 400);
        }
    }

    public function jobsByCompany(Company $company_id)
    {
        try {

            // dd();
            // Retrieve jobs by company ID
            $jobs = Jobs::where('company_id', $company_id->id)->get();


            // Check if jobs are found
            if ($jobs->isEmpty()) {
                return ResponseHelper::error(
                    message: 'No jobs found for the company.',
                    statusCode: 404
                );
            }

            // Return successful response with jobs data
            return ResponseHelper::success(
                message: 'Successfully fetched jobs for the company.',
                data:  ['Jobs'=>$jobs],
                statusCode: 200
            );
        } catch (\Exception $e) {
            Log::error('Exception while fetching jobs by company: ' . $e->getMessage());
            return ResponseHelper::error(
                message: 'Failed to fetch jobs for the company. Please try again.',
                statusCode: 500
            );
        }
    }

    /**
     * Display featured jobs 
     * 
     * @param NA
     * @return JSONResponse
     * 
     */

    public function featuredJobs()
    {
        try {
            $jobs = FeaturedJob::where('is_featured', true)->with('job')->get();


            if ($jobs->isEmpty()) {
                return ResponseHelper::error(message: 'No featured jobs currently available.', statusCode: 404);
            } else if (!$jobs) {
                return ResponseHelper::error(message: 'Failled to fetch featured Jobs. Try Again!', statusCode: 400);
            }

            return ResponseHelper::success(message: 'Successfuly fetch featured job listings', data: $jobs, statusCode: 200);
        } catch (Exception $e) {
            Log::error('Exception while fetching featured jobs!' . $e->getMessage() . ' - Line no. ' . $e->getLine());
            return ResponseHelper::error(message: 'Exception while fetching featured jobs!',  statusCode: 400);
        }
    }
}
