<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyContactUsMessageRequest;
use App\Http\Requests\StoreContactUsMessageRequest;
use App\Http\Requests\UpdateContactUsMessageRequest;
use App\Models\ContactUsMessage;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ContactUsMessagesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('contact_us_message_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ContactUsMessage::query()->select(sprintf('%s.*', (new ContactUsMessage)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'contact_us_message_show';
                $editGate      = 'contact_us_message_edit';
                $deleteGate    = 'contact_us_message_delete';
                $crudRoutePart = 'contact-us-messages';

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
            $table->editColumn('full_name', function ($row) {
                return $row->full_name ? $row->full_name : '';
            });
            $table->editColumn('phone_number', function ($row) {
                return $row->phone_number ? $row->phone_number : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('service_needed', function ($row) {
                return $row->service_needed ? $row->service_needed : '';
            });
            $table->editColumn('message', function ($row) {
                return $row->message ? $row->message : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.contactUsMessages.index');
    }

    public function create()
    {
        abort_if(Gate::denies('contact_us_message_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.contactUsMessages.create');
    }

    public function store(StoreContactUsMessageRequest $request)
    {
        $contactUsMessage = ContactUsMessage::create($request->all());

        return redirect()->route('admin.contact-us-messages.index');
    }

    public function edit(ContactUsMessage $contactUsMessage)
    {
        abort_if(Gate::denies('contact_us_message_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.contactUsMessages.edit', compact('contactUsMessage'));
    }

    public function update(UpdateContactUsMessageRequest $request, ContactUsMessage $contactUsMessage)
    {
        $contactUsMessage->update($request->all());

        return redirect()->route('admin.contact-us-messages.index');
    }

    public function show(ContactUsMessage $contactUsMessage)
    {
        abort_if(Gate::denies('contact_us_message_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.contactUsMessages.show', compact('contactUsMessage'));
    }

    public function destroy(ContactUsMessage $contactUsMessage)
    {
        abort_if(Gate::denies('contact_us_message_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contactUsMessage->delete();

        return back();
    }

    public function massDestroy(MassDestroyContactUsMessageRequest $request)
    {
        $contactUsMessages = ContactUsMessage::find(request('ids'));

        foreach ($contactUsMessages as $contactUsMessage) {
            $contactUsMessage->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
