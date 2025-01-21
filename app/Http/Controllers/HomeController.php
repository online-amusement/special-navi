<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MemberManagementService;

class HomeController extends Controller
{
    protected $memberManagementService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(MemberManagementService $memberManagementService)
    {
        $this->memberManagementService = $memberManagementService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $name = $request->input("name");
        $email = $request->input("email");
        $status = $request->input("status");
        $sort = $request->input("sort");

        $members = $this->memberManagementService->searchMember($name, $email, $status, $sort);

        $members = $members->withQueryString();

        return view('home', compact('members'));
    }

    public function create(Request $request)
    {
        $member = null;

        return view('member-edit', compact('member'));
    }

    public function edit(Request $request, $id)
    {
        $token = $request->bearerToken();

        $member = $this->memberManagementService->findBy("id", "=", $id)->first();

        $member = json_encode($member);

        return view('member-edit', compact('member'));
    }

    public function save(Request $request)
    {
        $id = $request->input('id');
        $name = $request->input('name');
        $email = $request->input('email');
        $postalCode = $request->input('postalCode');
        $address = $request->input('address');
        $address2 = $request->input('address2');
        $address3 = $request->input('address3');
        $tel = $request->input('tel');
        $status = $request->input('status');

        $member = $this->memberManagementService->memberEdit($id, $name, $email, $postalCode, $address, $address2, $address3, $tel, $status);

        return redirect()->to('/home');
    }

    public function delete($id, Request $request)
    {
        $member = $this->memberManagementService->findBy("id", "=", $id)->first();

        $member->delete();

        return redirect()->to('/home');
    }
}
