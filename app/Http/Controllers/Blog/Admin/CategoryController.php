<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Models\Admin\Category;
use App\Repositories\Admin\CategoryRepository;
use Exception;
use Illuminate\Http\Response;
use MetaTag;

class CategoryController extends AdminBaseController
{
    /**
     * @var
     */
    private $categoryRepository;

    /**
     * CategoryController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->categoryRepository = app(CategoryRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $arrMenu = Category::all();
        $menu = $this->categoryRepository->buildMenu($arrMenu);


        MetaTag::setTags(['title' => 'Category list']);
        return view('blog.admin.category.index', ['menu' => $menu]);
    }

    /**
     * @throws Exception
     */
    public function mydel()
    {
        $id = $this->categoryRepository->getRequestID();
        if (!$id) {
            return back()->withErrors(['msg' => 'Error with ID']);
        }

        $children = $this->categoryRepository->checkChildren($id);
        if ($children) {
            return back()
                ->withErrors(['msg' => 'Deletion is not possible, there are nested categories in the category']);
        }

        $parents = $this->categoryRepository->checkParentsProducts($id);
        if ($parents) {
            return back()
                ->withErrors(['msg' => 'Removal is not possible, there are products in the category']);
        }

        $delete = $this->categoryRepository->deleteCategory($id);
        if ($delete) {
            return redirect()
                ->route('blog.admin.categories.index')
                ->with(['success' => "The Record id [$id] removed"]);
        } else {
            return back()->withErrors(['msg' => 'Error delete']);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $item = new Category();
        $categoryList = $this->categoryRepository->getComboBoxCategories();

        MetaTag::setTags(['title' => 'Creating a new category']);
        return view('blog.admin.category.create', [
            'categories' => Category::with('children')
                ->where('parent_id', '0')
                ->get(),
            'delimiter' => '-',
            'item' => $item,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BlogCategoryUpdateRequest $request
     * @return void
     */
    public function store(BlogCategoryUpdateRequest $request)
    {
        $name = $this->categoryRepository->checkUniqueName($request->title, $request->parent_id);
        if ($name) {
            return back()
                ->withErrors(['msg' => 'It cannot be in the same Category two identical. Choose another category'])
                ->withInput();
        }

        $data = $request->input();
        $item = new Category();
        $item->fill($data)->save();
        if ($item) {
            return redirect()
                ->route('blog.admin.categories.create', [$item->id])
                ->with(['success' => 'Saved successfully']);
        } else {
            return back()
                ->withErrors(['msg' => 'Save error'])
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id, CategoryRepository $categoryRepository)
    {
        $item = $this->categoryRepository->getId($id);
        if (empty($item)) {
            abort(404);
        }

        MetaTag::setTags(['title' => "Updating the category № $id"]);
        return view('blog.admin.category.edit', [
            'categories' => Category::with('children')
                ->where('parent_id', '0')
                ->get(),
            'delimiter' => '-',
            'item' => $item,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BlogCategoryUpdateRequest $request
     * @param int $id
     * @return Response
     */
    public function update(BlogCategoryUpdateRequest $request, $id)
    {
        $item = $this->categoryRepository->getId($id);
        if (empty($item)) {
            return back()
                ->withErrors(['msg' => "Record = [{$id}] not found"])
                ->withInput();
        }

        $data = $request->all();
       $result = $item->update($data);
        if ($result) {
            return redirect()
                ->route('blog.admin.categories.edit', $item->id)
                ->with(['success' => 'Saved successfully']);
        } else {
            return back()
                ->withErrors(['msg' => 'Save error'])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
