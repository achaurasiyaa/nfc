<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyItemRequest;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Item;
use App\Worker;
use App\Asset;
use App\ItemCategory;
use App\ItemNfcRel;
class ItemsController extends Controller
{
    public function index()
    {
//         dd('as');
        abort_if(Gate::denies('item_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $items = Item::all();

        return view('admin.items.index', compact('items'));
    }

    public function create()
    {
        abort_if(Gate::denies('item_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $itemCategories = ItemCategory::all();
        return view('admin.items.create', compact('itemCategories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'supplier_name' => 'required|string|max:255',
            'quantity' => 'required|integer',
            'ageing_in_days' => 'required|integer',
            'category_id' => 'required|exists:item_categories,id',
        ]);

        $item = Item::create($data);

        $nfcSerialNumbers = [];
        for ($i = 0; $i < $data['quantity']; $i++) {
            $nfcSerialNumbers[] = $this->generateNfcSerialNumber();
        }

        foreach ($nfcSerialNumbers as $nfcSerialNumber) {
            ItemNfcRel::create([
                'nfc_serial_number' => $nfcSerialNumber,
                'item_id' => $item->id,
            ]);
        }

        return redirect()->route('admin.items.index')->with('success', 'Item created successfully.');
    }

    private function generateNfcSerialNumber()
    {
        return \Illuminate\Support\Str::uuid()->toString();
    }

    public function edit(Item $item)
    {
        abort_if(Gate::denies('item_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.items.edit', compact('item'));
    }

    public function update(UpdateItemRequest $request, Item $item)
    {
        try
        {
            $item->update($request->all());
        }
        catch (\Exception $e) {
            // Log or display the error message
            dd($e->getMessage());
        }

        return redirect()->route('admin.items.index');

    }

    public function show(Item $item)
    {
        abort_if(Gate::denies('item_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $category = ItemCategory::findOrFail($item->category_id);
        $categoryName = $category->name;
        return view('admin.items.show', compact('item', 'categoryName'));
    }

    public function destroy(Item $item)
    {
        abort_if(Gate::denies('item_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $item->delete();

        return back();

    }

    public function massDestroy(MassDestroyItemRequest $request)
    {
        Item::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

    public function addWorkers(Worker $request)
    {
        return view('workers.create');
    }

    public function category(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'image' => 'required|image|max:2048',
            ]);
            $category = new ItemCategory();
            $category->name = $validatedData['name'];
            $category->description = $validatedData['description'];

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('images');
                $category->image = $imagePath;
            }

            $category->save();

            return redirect()->route('admin.items.index')->with('success', 'Category created successfully!');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Failed to create category. Please try again.');
        }
    }
}
