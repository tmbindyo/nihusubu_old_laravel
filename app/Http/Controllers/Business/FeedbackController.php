<?php

namespace App\Http\Controllers\Business;

use App\Upload;
use App\Feedback;
use App\Campaign;
use App\UploadType;
use App\CampaignType;
use App\Traits\UserTrait;
use Illuminate\Http\Request;
use App\Traits\InstitutionTrait;
use App\Http\Controllers\Controller;
use App\Traits\DocumentExtensionTrait;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class FeedbackController extends Controller
{

    use UserTrait;
    use institutionTrait;
    use DocumentExtensionTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    // feedbacks
    public function feedbacks($portal)
    {
        // User
        $user = $this->getUser();
        // Get institutions
        $institution = $this->getInstitution($portal);
        // get feedbacks
        $feedbacks = Feedback::where('institution_id',$institution->id)->with('user','status')->get();
        // get feedbacks
        $deletedFeedbacks = Feedback::where('institution_id',$institution->id)->with('user','status')->onlyTrashed()->get();
        return view('business.feedbacks',compact('feedbacks','user','institution','deletedFeedbacks'));
    }

    public function feedbackCreate($portal)
    {
        // User
        $user = $this->getUser();
        // Get institutions
        $institution = $this->getInstitution($portal);
        return view('business.feedback_create',compact('user','institution'));
    }

    public function feedbackStore(Request $request, $portal)
    {
        // User
        $user = $this->getUser();
        // Get institutions
        $institution = $this->getInstitution($portal);

        $feedback = new Feedback();
        $feedback->name = $request->name;
        $feedback->description = $request->description;
        $feedback->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $feedback->user_id = $user->id;
        $feedback->institution_id = $institution->id;
        $feedback->is_institution = True;
        $feedback->is_user = False;
        $feedback->save();

        return redirect()->route('business.feedback.show',['portal'=>$institution->portal,'id'=>$feedback->id])->withSuccess('Feedback updated!');
    }

    public function feedbackShow($portal, $feedback_id)
    {
        // Check if feedback exists
        $feedbackExists = Feedback::findOrFail($feedback_id);
        // User
        $user = $this->getUser();
        // Get institutions
        $institution = $this->getInstitution($portal);
        // Get feedback
        $feedback = Feedback::with('user','status')->where('is_institution',True)->where('id',$feedback_id)->first();
        return view('business.feedback_show',compact('feedback','user','institution'));
    }

    public function feedbackUpdate(Request $request, $portal, $feedback_id)
    {
        // Get institutions
        $institution = $this->getInstitution($portal);

        $feedback = Feedback::findOrFail($feedback_id);
        $feedback->name = $request->name;
        $feedback->save();

        return redirect()->route('business.feedback.type.show',['portal'=>$institution->portal,'id'=>$feedback->id])->withSuccess('Feedback updated!');
    }

    public function feedbackUploads($portal, $feedback_id)
    {
        // Check if contact type exists
        $feedbackExists = Feedback::findOrFail($feedback_id);
        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution($portal);
        // Get feedbacks
        $feedback = Feedback::where('institution_id',$institution->id)->with('user','status','feedback_uploads')->withCount('feedback_uploads')->where('id',$feedback_id)->first();
        // Feedback uploads
        $feedbackUploads = Upload::with('user','status')->where('id',$feedback_id)->get();

        return view('business.feedback_uploads',compact('feedback','user','institution','feedbackUploads'));
    }

    public function feedbackUpload($portal, $feedback_id)
    {
        // Check if contact type exists
        $feedbackExists = Feedback::findOrFail($feedback_id);
        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution($portal);
        // Get feedbacks
        $feedback = Feedback::where('institution_id',$institution->id)->where('is_institution',true)->with('user','status','feedback_type','feedback_upload','contacts','expenses','organizations','to_dos')->withCount('feedback_upload','contacts','expenses','organizations','to_dos')->where('id',$feedback_id)->first();
        // Feedback uploads
        $feedbackUploads = Upload::with('user','status')->where('id',$feedback_id)->first();
        // upload types
        $uploadTypes = UploadType::get();

        return view('business.feedback_uploads',compact('feedback','user','institution','feedbackTypes','uploadTypes'));
    }

    public function feedbackUploadStore(Request $request,$portal,$feedback_id)
    {

        // User
        $user = $this->getUser();
        // Get institution
        $institution = $this->getInstitution($portal);

        $feedback = Feedback::where('institution_id',$institution->id)->where('id',$feedback_id)->first();
        $originalFolderName = str_replace(' ', '', $portal.'/feedback/'.$feedback->name."/");

//        return $originalFolderName;

//        $file = $request->file('file');
//        $file_name_extension = $file->getClientOriginalName();
//        $extension = $file->getClientOriginalExtension();

        $file = Input::file("file");
        $size = $request->file("file")->getSize();
        $file_name_extension = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();

        $file->move(public_path()."/files/".$originalFolderName, $file_name_extension);
        $path = public_path()."/files/".$originalFolderName.$file_name_extension;

        $file_name = pathinfo($path, PATHINFO_FILENAME);
        $image_name = $file_name.'.'.$extension;

//        $size = $request->file($path)->getSize();
        $file_name = pathinfo($path, PATHINFO_FILENAME);
        $image_name = $file_name.'.'.$extension;

        $upload = new Upload();
        // Get the extension type
        $extensionType = $this->uploadExtension($extension);
        $upload->file_type = $extensionType;

        $upload->name = $file_name;
        $upload->extension = $extension;
        $upload->size = $size;

        $upload->original = "files/".$originalFolderName.$image_name;

        $upload->feedback_id = $feedback_id;
        $upload->upload_type_id = "11bde94f-e686-488e-9051-bc52f37df8cf";
        $upload->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $upload->user_id = $user->id;
        $upload->save();

        return back()->withSuccess(__('Feedback file successfully uploaded.'));
    }

    public function feedbackUploadDownload($portal, $upload_id)
    {
        $uploadExists = Upload::findOrFail($upload_id);
        $upload = Upload::where('id',$upload_id)->first();

        // return $upload->original;
        $file_path = public_path($upload->original);
        return response()->download($file_path);
    }

    public function feedbackDelete($portal, $feedback_id)
    {

        $feedback = Feedback::findOrFail($feedback_id);
        $feedback->status_id= "d35b4cee-5594-4cfd-ad85-e489c9dcdeff";
        $feedback->save();

        return back()->withSuccess(__('Feedback '.$feedback->name.' successfully deleted.'));
    }
    public function feedbackRestore($portal, $feedback_id)
    {

        $feedback = Feedback::findOrFail($feedback_id);
        $feedback->status_id= "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $feedback->save();

        return back()->withSuccess(__('Feedback '.$feedback->name.' successfully restored.'));
    }

}
