<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Block;
use App\Models\BlockCategory;
use App\Models\Page;
use App\Models\PageDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class BlockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    

    // Blocks
    public function print($pageId)
    {
        $pagePrint = Page::findOrFail($pageId);
        $projectPrint = Project::findOrFail($pagePrint->project_id);
        $blockPrint = PageDetails::with('blocks')->where('page_id', $pageId)->get();
    
        return view('print.block_print', compact('pagePrint', 'blockPrint', 'projectPrint'));
    }    
    
    public function blockMaster()
    {
        $blockCategory = Block::with('categories')->get();
        return view('block_master.block_master', compact('blockCategory'));
    }
    
    public function blockMasterCreate()
    {
        $blockCategoryCreate = BlockCategory::all();

        return view('block_master.block_master_create', compact('blockCategoryCreate'));
    }
    
    public function blockMasterPost(Request $request)
    {
        $request->validate([
            'block_name' => 'required',
            'category_id' => 'required',
            'main_image' => 'required|image|mimes:jpeg,png,jpg',
            'mobile_image' => 'required|image|mimes:jpeg,png,jpg',
            'sample_image_1' => 'required|image|mimes:jpeg,png,jpg',
            'sample_image_2' => 'required|image|mimes:jpeg,png,jpg',
        ]);
        
        $mainImage = $request->file('main_image')->store('public/images/main_image');
        $mobileImage = $request->file('mobile_image')->store('public/images/mobile_image');
        $sampelImage1 = $request->file('sample_image_1')->store('public/images/sample_image_1');
        $sampelImage2 = $request->file('sample_image_2')->store('public/images/sample_image_2');

        Block::create([
            'block_name' => $request->block_name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'status' => $request->status,
            'main_image' => $mainImage,
            'mobile_image' => $mobileImage,
            'sample_image_1' => $sampelImage1,
            'sample_image_2' => $sampelImage2,
        ]);

        return redirect()->route('block.master')->with('createBlockMaster', 'Berhasil membuat block');
    }

    public function blockMasterEdit($id)
    {
        $blockEdit = Block::findOrFail($id);
        $blockCategoryEdit = BlockCategory::all();
        
        return view('block_master.block_master_edit', compact('blockEdit', 'blockCategoryEdit'));
    }

    public function blockMasterUpdate(Request $request, $id)
    {
        $request->validate([
            'block_name' => 'required',
            'category_id' => 'required',
            'main_image' => 'image|mimes:jpeg,png,jpg',
        ]);
        
        $block = Block::findOrFail($id);

        $mainImage = $block->main_image;

        if ($request->hasFile('main_image')) {
            $mainImage = $request->file('main_image')->store('public/images/main_image');
            Storage::delete('public/images/main_image/' . $block->main_image);
        }

        $block->update([
            'block_name' => $request->block_name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'status' => $request->status,
            'main_image' => $mainImage,
        ]);
        
        return redirect()->route('block.master')->with('updateBlockMaster', 'Berhasil mengubah block');
    }

    public function blockMasterDelete($id)
    {
        Block::where('id', '=', $id)->delete();
        return redirect()->route('block.master')->with('deleteBlockMaster', 'Berhasil menghapus block');
    }

    public function block($id)
    {
        $pageDB = Page::findOrFail($id);
        $blockList = PageDetails::with('pages')->where('page_id', $id)->get();
        return view('blocks.block', compact( 'blockList', 'pageDB'));
    }

    public function deleteBlock($id)
    {
        $pageDetailsDelete = PageDetails::findOrFail($id);
        $page_id = $pageDetailsDelete->page_id;

        // Hapus data
        $pageDetailsDelete->delete(); 

        // Perbarui nomor urutan data
        $pageDetails = PageDetails::where('page_id', $page_id)->orderBy('sort')->get();
        foreach ($pageDetails as $key => $detail) {
            $detail->update(['sort' => $key + 1]);
        }

        // Berhasil menghapus data, arahkan kembali ke halaman /block dengan pemberitahuan
        return redirect()->route('block', $page_id)->with('deleteBlock', 'Berhasil menghapus data!');
    }

    public function blockCreate($id)
    {
        $page    = Page::with('projects', 'projects.projectManager')->findOrFail($id);
        $blockDB = Block::with('categories')->get();
        return view('blocks.block_create', compact('page', 'blockDB'));
    }

    public function postBlock(Request $request, $id)
    {
        $page = Page::findOrFail($id);
        $request->validate([
            'section_name' => 'required|min:3',
            'block_id' => 'required',
        ]);

        // Menghitung urutan data
        $lastSort = PageDetails::where('page_id', $page->id)->max('sort');
        $sort = $lastSort + 1; 


        // Membuat data baru dengan isian dari request
        PageDetails::create([
            'section_name' => $request->section_name,
            'note' => $request->note,
            'block_id' => $request->block_id,
            'page_id' => $page->id, //mengambil id dari objek page
            'sort' => $sort++,
        ]);
        
        // Jika berhasil, arahkan ke halaman /page dengan pemberitahuan berhasil
        return redirect()->route('block', $page->id)->with('createblock', 'Berhasil membuat block!');
    }

    public function blockEdit($id)
    {
        $blockEdit = PageDetails::findOrFail($id);
        $blockDB   = Block::all();
        $page      = Page::with('projects', 'projects.projectManager')->findOrFail($blockEdit->page_id);
        
        // $pageSec = Page::select('pages.*', 'projects.project_name as project_name', 'project_managers.name as project_manager')
        //                 ->join('projects', 'projects.id', '=', 'pages.project_id')
        //                 ->join('project_managers', 'project_managers.id', '=', 'projects.project_manager')
        //                 ->find($blockEdit->page_id);
        
        return view('blocks.block_edit', compact('blockDB', 'blockEdit', 'page'));
    } 

    public function updateBlock(Request $request, $id)
    {
        $request->validate([
            'section_name' => 'required|min:3',
            'block_id' => 'required',
        ]);

        $page = PageDetails::findOrFail($id);

        // Ubah sort dari item yang sedang diedit menjadi sort yang baru diinputkan
        $page->update([
            'section_name' => $request->section_name,
            'note' => $request->note,
            'block_id' => $request->block_id,
            'sort' => $request->sort,
        ]);

        // Dapatkan project_id dari halaman yang diupdate
        $page_id = $page->page_id;

        // Kalau berhasil, arahkan ke halaman proyek dengan pemberitahuan berhasil
        return redirect()->route('block', $page_id)->with('updatePage', 'Berhasil mengubah page!');
    }


    public function blockCategory()
    {
        $categoriesDB = BlockCategory::all();
        return view('blocks.block_categories', compact('categoriesDB'));
    }

    public function postCategory(Request $request)
    {
        $request->validate([
            'category_name' => 'required|min:3',
        ]);

        // bikin data baru dengan isian dari request
        BlockCategory::create([
            'category_name' => $request->category_name,
        ]);
        return redirect()->route('block.categories')->with('createCategory', 'Berhasil membuat Category baru!');
    }

    public function updateCategory(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required|min:3'
        ]);

        BlockCategory::find($id)->update([
            'category_name' => $request->category_name,
        ]);

        return redirect()->route('block.categories')->with('updateCategory', 'Berhasil merubah Category!');
    }

    public function deleteCategory(Request $request, $id)
    {
        BlockCategory::where('id', '=', $id)->delete();
        return redirect()->route('block.categories')->with('deleteCategory', 'Berhasil menghapus Category.');
    }




    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Block $block)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Block $block)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Block $block)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Block $block)
    {
        //
    }
}
