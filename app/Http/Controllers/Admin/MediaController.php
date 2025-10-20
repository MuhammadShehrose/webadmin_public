<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\MediaRepository;

class MediaController extends Controller
{
    protected $repo;

    public function __construct(MediaRepository $repo)
    {
        $this->repo = $repo;

        $this->middleware('permission:media.view')->only('index');
        $this->middleware('permission:media.delete')->only('destroy');
        $this->middleware('permission:media.delete_folder')->only('deleteFolder');
    }

    /**
     * Display files grouped by folders, optionally filtered
     */
    public function index(Request $request)
    {
        $folders = $this->repo->getFolders();
        $selected = $request->get('folder');

        if ($selected) {
            $groupedMedia = [$selected => $this->repo->getFiles($selected)];
        } else {
            $groupedMedia = $this->repo->getAllGrouped();
        }

        // Flatten all files for view checks
        $mediaFiles = collect($groupedMedia)->flatten(1)->toArray();

        return view('admin.media.index', compact('folders', 'groupedMedia', 'mediaFiles', 'selected'));
    }

    /**
     * Delete file safely
     */
    public function destroy(Request $request)
    {
        if ($request->path) {
            $this->repo->delete($request->path);
        }

        return back()->with('success', 'File deleted successfully!');
    }

    public function deleteFolder(Request $request)
    {
        try {
            // Use repository to perform the actual deletion
            if ($request->name) {
                $deleted = $this->repo->deleteFolder($request->name);
            }

            if ($deleted) {
                return redirect()->route('admin.media.index')
                    ->with('success', "Folder deleted successfully!");
            }

            return redirect()->route('admin.media.index')
                ->with('error', "Failed to delete folder. It may not exist or could not be removed.");
        } catch (\Exception $e) {
            return redirect()->route('admin.media.index')
                ->with('error', 'Error deleting folder: ' . $e->getMessage());
        }
    }
}
