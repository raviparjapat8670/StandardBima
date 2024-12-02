<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\occupation\CreateOccupationRequest;
use App\Http\Requests\admin\occupation\EditOccupationRequest;
use App\Http\Requests\admin\occupation\GetOccupationRequest;
use Illuminate\Http\Request;
use App\Services\admin\OccupationService;
use Illuminate\Support\Facades\Crypt;

class OccupationController extends Controller
{
    //
    protected $occupationService;

    public function __construct(OccupationService $occupationService)
    {
        $this->occupationService = $occupationService;
    }
    public function index(GetOccupationRequest $request){
        $validated = $request->validated();
        // Retrieve the list of users from the UserService
        $occupations = $this->occupationService->getOccupations($validated);
        return view('admin.occupations.index',compact('occupations'));
    }
    public function CreateOccupation(CreateOccupationRequest $request)
    {

        if ($request->isMethod('get')) {
            // For GET request: Show the form
            return view('admin.occupations.create');  // This is your form view
        }


        // Use the CreateUserRequest only for POST requests
        $validated = $request->validated(); // Manually validate on POST request

        // Retrieve the cretaed of user from the UserService
        $occupation = $this->occupationService->CreateOccupation($validated);

        if ($occupation) {
            session()->flash('success', 'Occupation has been created successfully.');
            return redirect()->route('admin.occupations');
        }

        session()->flash('error', 'Sorry something went wrong! Please try again later.');
        return redirect()->route('admin.occupations');
    }

        // Show Occupation details or edit the Occupation
        public function EditOccupation(EditOccupationRequest $request, $id)
        {
            if ($request->isMethod('get')) {
                // Decrypt the ID
                $id = Crypt::decrypt($id);
                $occupation = $this->occupationService->getOccupationById($id); // Get the user or throw 404 if not found
                // If the request is GET, display the user details with the edit form
                return view('admin.occupations.edit', compact('occupation'));
            }
    
            // If the request is POST, update the user details
            $validated = $request->validated(); // Manually validate on POST request
            // Update the user
    
            $validated['id'] = $request->input('id');
            // Retrieve the edit of user from the UserService
            $occupation = $this->occupationService->EditOccupation($validated);
            if ($occupation) {
                // Redirect back to the user details page with a success message
                session()->flash('success', 'Occupation details updated successfully.');
                return redirect()->route('admin.occupations');
            }
            // Redirect back to the user details page with a error message
            session()->flash('error', 'Sorry something went wrong! Please try again later.');
            return redirect()->route('admin.occupations');
        }
}

