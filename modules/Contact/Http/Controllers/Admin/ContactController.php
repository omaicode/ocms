<?php

namespace Modules\Contact\Http\Controllers\Admin;

use ApiResponse;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use InvalidArgumentException;
use Modules\Contact\Entities\Contact;
use Modules\Contact\Repositories\ContactRepository;
use Modules\Contact\Tables\ContactTable;
use Modules\Core\Contracts\AdminPage;
use Modules\Core\Supports\ApiResponse as SupportsApiResponse;

class ContactController extends Controller
{
    /**
     * 
     * @var Request
     */
    protected Request $request;

    /**
     * 
     * @var ContactRepository
     */
    protected ContactRepository $repository;

    /**
     * 
     * @var array
     */
    protected array $breadcrumb = [];

    public function __construct(Request $request, ContactRepository $repository)
    {
        $this->middleware('can:contact.view', ['index']);
        
        $this->request = $request;
        $this->repository = $repository;
        $this->breadcrumb = [
            [
                'title' => __('contact::messages.contacts'),
                'url'   => '#'
            ]
        ];
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(AdminPage $page)
    {
        return $page
        ->breadcrumb($this->breadcrumb)
        ->body(new ContactTable());
    }

    /**
     * 
     * @return SupportsApiResponse 
     * @throws InvalidArgumentException 
     */
    public function destroy()
    {
        $rows = $this->request->rows;
        Contact::whereIn('id', $rows)->delete();

        return ApiResponse::success();
    }    
}
