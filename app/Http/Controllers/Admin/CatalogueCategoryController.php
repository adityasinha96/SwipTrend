<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCatalogueCategoryRequest;
use App\Http\Requests\StoreCatalogueCategoryRequest;
use App\Http\Requests\UpdateCatalogueCategoryRequest;
use App\Models\CatalogueCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CatalogueCategoryController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('catalogue_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = CatalogueCategory::query()->select(sprintf('%s.*', (new CatalogueCategory)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'catalogue_category_show';
                $editGate      = 'catalogue_category_edit';
                $deleteGate    = 'catalogue_category_delete';
                $crudRoutePart = 'catalogue-categories';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('category_icon', function ($row) {
                return $row->category_icon ? $row->category_icon : '';
            });
            $table->editColumn('category_name', function ($row) {
                return $row->category_name ? $row->category_name : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.catalogueCategories.index');
    }

    public function create()
    {
        abort_if(Gate::denies('catalogue_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.catalogueCategories.create');
    }

    public function store(StoreCatalogueCategoryRequest $request)
    {
        $catalogueCategory = CatalogueCategory::create($request->all());

        return redirect()->route('admin.catalogue-categories.index');
    }

    public function edit(CatalogueCategory $catalogueCategory)
    {
        abort_if(Gate::denies('catalogue_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.catalogueCategories.edit', compact('catalogueCategory'));
    }

    public function update(UpdateCatalogueCategoryRequest $request, CatalogueCategory $catalogueCategory)
    {
        $catalogueCategory->update($request->all());

        return redirect()->route('admin.catalogue-categories.index');
    }

    public function show(CatalogueCategory $catalogueCategory)
    {
        abort_if(Gate::denies('catalogue_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.catalogueCategories.show', compact('catalogueCategory'));
    }

    public function destroy(CatalogueCategory $catalogueCategory)
    {
        abort_if(Gate::denies('catalogue_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $catalogueCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroyCatalogueCategoryRequest $request)
    {
        $catalogueCategories = CatalogueCategory::find(request('ids'));

        foreach ($catalogueCategories as $catalogueCategory) {
            $catalogueCategory->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
