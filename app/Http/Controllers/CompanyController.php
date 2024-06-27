<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Models\Company;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CompanyController extends Controller
{
    /**
     * Display all company with Job Listings
     * @param  NA
     * @return JSONResponse
     */
    public function showCompany()
    {
        try {
            $sort_by = 'created_at';
            $direction = 'desc';

            $companies = Company::query()
                ->orderBy($sort_by, $direction)
                ->get();

            // if no companies exists 
            if ($companies->isEmpty()) {
                return ResponseHelper::error(
                    message: 'No Companies available with job listing',
                    statusCode: 404,
                );
            }

            if ($companies) {
                return ResponseHelper::success(
                    message: "Successfully fetch of all companies",
                    data: $companies,
                    statusCode: 200
                );
            }
            return ResponseHelper::error(message: 'Failled to display Companies with Job listings. Please try again!',  statusCode: 400);
        } catch (Exception $e) {
            Log::error('Exception while displaying Companies with listings' . $e->getMessage() . ' - Line no. ' . $e->getLine());
            return ResponseHelper::error(message: 'Exception while displaying Companies with Job listings!',  statusCode: 400);
        }
    }

    /**
     * Display a single company by id.
     * @param company_id
     * @return JSONResponse
     */
    public function showSingleCompany(Company $company_id)
    {
        try {

            // Fetch the company associated with the id 
            $company  =  Company::findOrFail($company_id->id);

            if ($company) {
                return ResponseHelper::success(
                    message: 'Successfully fetch a company by that ID',
                    data: $company,
                    statusCode: 200
                );
            }
            return ResponseHelper::error(message: 'Failled to fetch company with that ID. Please try again!',  statusCode: 400);
        } catch (ModelNotFoundException $e) {
            // where the company id is not found in the model
            return ResponseHelper::error(
                message: "No company exist with that ID, Try Again!",
                statusCode: 404
            );
        } catch (Exception $e) {
            Log::error('Exception while fetching company by that ID!' . $e->getMessage() . ' - Line no. ' . $e->getLine());
            return ResponseHelper::error(message: 'Exception while fetching company by that ID!',  statusCode: 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
