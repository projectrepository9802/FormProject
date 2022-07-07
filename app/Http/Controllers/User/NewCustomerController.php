<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Billing;
use App\Models\Customer;
use App\Models\Technical;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewCustomerController extends Controller
{
    public function indexPersonal()
    {
        $datas = [
            'titlePage' => 'Form Registrasi Layanan Baru'
        ];

        return view('user.pages.newcustomer.personal', $datas);
    }

    public function storePersonal(Request $request)
    {
        $uuid = $request->get('uuid');
        $idPelanggan = 'PC'.date('YmdHis');

        // Personal Validation
        $validator1 = Validator::make(
            $request->all(),
            [
                'uuid' => 'required',
                'personal_name' => 'required',
                'identity_personal_number' => 'required',
                'email_address' => 'required|email',
                'personal_address' => 'required'
            ],
            [
                'personal_name.required' => 'Field Nama Lengkap Wajib Diisi',
                'identity_personal_number.required' => 'Field Nomor Identitas Wajib Diisi',
                'email_address.required' => 'Field Alamat Email Wajib Diisi',
                'email_address.email' => 'Email Tidak Valid',
                'personal_address.required' => 'Field Alamat Lengkap Wajib Diisi'
            ]
        );

        if ($validator1->fails()) {
            return redirect('new-member/personal/' . $uuid . '#personal-info')
                ->withErrors($validator1)
                ->withInput();
        }

        // Billing Validation
        $validator2 = Validator::make(
            $request->all(),
            [
                'billing_name' => 'required',
                'billing_phone' => 'required',
                'billing_email' => 'required|email'
            ],
            [
                'billing_name.required' => 'Field Nama Biller Wajib Diisi',
                'billing_phone.required' => 'Field Nomor Handphone Biller Wajib Diisi',
                'billing_email.required' => 'Field Alamat Email Biller Wajib Diisi',
                'billing_email.email' => 'Email Tidak Valid'
            ]
        );

        if ($validator2->fails()) {
            return redirect('new-member/personal/' . $uuid . '#billing-info')
                ->withErrors($validator2)
                ->withInput();
        }

        // Technical Validation
        $validator3 = Validator::make(
            $request->all(),
            [
                'technical_service' => 'required',
                'technical_identity_photo' => 'required|mimes:jpeg,jpg,png|max:2048',
                'technical_selfie_photo' => 'required|mimes:jpeg,jpg,png|max:2048'
            ],
            [
                'technical_service.required' => 'Field Pilihan Layanan Wajib Diisi',
                'technical_identity_photo.required' => 'Field Foto Identitas Wajib Diisi',
                'technical_identity_photo.mimes' => 'Field Foto Identitas harus berformat jpeg,jpg,png',
                'technical_identity_photo.max' => 'Field Foto Identitas harus berukuran min. 2 MB',
                'technical_selfie_photo.required' => 'Field Selfie dengan Foto Identitas Wajib Diisi',
                'technical_selfie_photo.mimes' => 'Field Selfie dengan Foto Identitas harus berformat jpeg,jpg,png',
                'technical_selfie_photo.max' => 'Field Selfie dengan Foto Identitas harus berukuran min. 2 MB'
            ]
        );

        if ($validator3->fails()) {
            return redirect('new-member/personal/' . $uuid . '#technical-info')
                ->withErrors($validator3)
                ->withInput();
        }

        $fileIdentityPhoto = $request->file('technical_identity_photo');
        $tujuan_upload = 'bin/img/Personal/Identity';
        $fileIdentityPhoto->move($tujuan_upload, $fileIdentityPhoto->getClientOriginalName());

        $fileSelfiePhoto = $request->file('technical_selfie_photo');
        $tujuan_upload = 'bin/img/Personal/SelfieID';
        $fileSelfiePhoto->move($tujuan_upload, $fileSelfiePhoto->getClientOriginalName());

        // Checked Data
        $finder['customer'] = Customer::find($validator1->validated()['uuid']) == null ? false : true;
        $finder['billing'] = Billing::find($validator1->validated()['uuid']) == null ? false : true;
        $finder['technical'] = Technical::find($validator1->validated()['uuid']) == null ? false : true;

        // Executed Process of Personal Forms
        // Customer Part
        $newCustomer = new Customer();
        $newCustomer->id = $validator1->validated()['uuid'];
        $newCustomer->id_pelanggan = $idPelanggan;
        $newCustomer->name = $validator1->validated()['personal_name'];
        $newCustomer->address = $validator1->validated()['personal_address'];
        $newCustomer->class = 'Personal';
        $newCustomer->email = $validator1->validated()['email_address'];
        $newCustomer->identity_number = $validator1->validated()['identity_personal_number'];
        $newCustomer->save();

        $newBilling = new Billing();
        $newBilling->id = $validator1->validated()['uuid'];
        $newBilling->billing_name = $validator2->validated()['billing_name'];
        $newBilling->billing_contact = $validator2->validated()['billing_phone'];
        $newBilling->billing_email = $validator2->validated()['billing_email'];
        $newBilling->save();

        $newTechnical = new Technical();
        $newTechnical->id = $validator1->validated()['uuid'];
        $newTechnical->service_package = $validator3->validated()['technical_service'];
        $newTechnical->id_photo_url = $tujuan_upload . '/' . $fileIdentityPhoto->getClientOriginalName();
        $newTechnical->selfie_id_photo_url = $tujuan_upload . '/' . $fileSelfiePhoto->getClientOriginalName();
        $newTechnical->save();

        return redirect()->to('new-member')->with('message', 'Selamat, Anda Berhasil Registrasi.');
    }

    public function indexBussiness()
    {
        $datas = [
            'titlePage' => 'Form Registrasi Layanan Baru'
        ];

        return view('user.pages.newcustomer.bussiness', $datas);
    }

    public function storeBussiness(Request $request)
    {
        $uuid = $request->get('uuid');
        $idPelanggan = 'BC'.date('YmdHis');

        // Personal Validation
        $validator1 = Validator::make(
            $request->all(),
            [
                'uuid' => 'required',
                'personal_name' => 'required',
                'identity_number' => 'required',
                'email_address' => 'required|email',
                'personal_address' => 'required',
                'company_name' => 'required',
                'company_address' => 'required',
                'company_npwp' => 'required',
                'company_employees' => 'required'
            ],
            [
                'personal_name.required' => 'Field Nama Lengkap Wajib Diisi',
                'identity_number.required' => 'Field Nomor Identitas Wajib Diisi',
                'email_address.required' => 'Field Alamat Email Wajib Diisi',
                'email_address.email' => 'Email Tidak Valid',
                'personal_address.required' => 'Field Alamat Lengkap Wajib Diisi',
                'company_name.required' => 'Field Nama Perusahaan Wajib Diisi',
                'company_address.required' => 'Field Alamat Perusahaan Wajib Diisi',
                'company_npwp.required' => 'Field NPWP Perusahaan Wajib Diisi',
                'company_employees.required' => 'Field Jumlah Pegawai Wajib Diisi',
            ]
        );

        if ($validator1->fails()) {
            return redirect('new-member/bussiness/' . $uuid . '#personal-info')
                ->withErrors($validator1)
                ->withInput();
        }

        // Billing Validation
        $validator2 = Validator::make(
            $request->all(),
            [
                'billing_name' => 'required',
                'billing_phone' => 'required',
                'billing_email' => 'required|email'
            ],
            [
                'billing_name.required' => 'Field Nama Biller Wajib Diisi',
                'billing_phone.required' => 'Field Nomor Handphone Biller Wajib Diisi',
                'billing_email.required' => 'Field Alamat Email Biller Wajib Diisi',
                'billing_email.email' => 'Email Tidak Valid'
            ]
        );

        if ($validator2->fails()) {
            return redirect('new-member/bussiness/' . $uuid . '#billing-info')
                ->withErrors($validator2)
                ->withInput();
        }

        // // Technical Validation
        $validator3 = Validator::make(
            $request->all(),
            [
                'technical_service' => 'required',
                'technical_identity_photo' => 'required|mimes:jpeg,jpg,png|max:2048',
                'technical_selfie_photo' => 'required|mimes:jpeg,jpg,png|max:2048'
            ],
            [
                'technical_service.required' => 'Field Pilihan Layanan Wajib Diisi',
                'technical_identity_photo.required' => 'Field Foto Identitas Wajib Diisi',
                'technical_identity_photo.mimes' => 'Field Foto Identitas harus berformat jpeg,jpg,png',
                'technical_identity_photo.max' => 'Field Foto Identitas harus berukuran min. 2 MB',
                'technical_selfie_photo.required' => 'Field Selfie dengan Foto Identitas Wajib Diisi',
                'technical_selfie_photo.mimes' => 'Field Selfie dengan Foto Identitas harus berformat jpeg,jpg,png',
                'technical_selfie_photo.max' => 'Field Selfie dengan Foto Identitas harus berukuran min. 2 MB'
            ]
        );

        if ($validator3->fails()) {
            return redirect('new-member/bussiness/' . $uuid . '#technical-info')
                ->withErrors($validator3)
                ->withInput();
        }

        $fileIdentityPhoto = $request->file('technical_identity_photo');
        $tujuan_upload = 'bin/img/Bussiness/Identity';
        $fileIdentityPhoto->move($tujuan_upload, $fileIdentityPhoto->getClientOriginalName());

        $fileSelfiePhoto = $request->file('technical_selfie_photo');
        $tujuan_upload = 'bin/img/Bussiness/SelfieID';
        $fileSelfiePhoto->move($tujuan_upload, $fileSelfiePhoto->getClientOriginalName());

        // Checked Data
        $finder['customer'] = Customer::find($validator1->validated()['uuid']) == null ? false : true;
        $finder['billing'] = Billing::find($validator1->validated()['uuid']) == null ? false : true;
        $finder['technical'] = Technical::find($validator1->validated()['uuid']) == null ? false : true;

        // Executed Process of Personal Forms
        // Customer Part
        $newCustomer = new Customer();
        $newCustomer->id = $validator1->validated()['uuid'];
        $newCustomer->id_pelanggan = $idPelanggan;
        $newCustomer->name = $validator1->validated()['personal_name'];
        $newCustomer->identity_number = $validator1->validated()['identity_number'];
        $newCustomer->email = $validator1->validated()['email_address'];
        $newCustomer->address = $validator1->validated()['personal_address'];
        $newCustomer->company_name = $validator1->validated()['company_name'];
        $newCustomer->company_address = $validator1->validated()['company_address'];
        $newCustomer->company_npwp = $validator1->validated()['company_npwp'];
        $newCustomer->company_employees = $validator1->validated()['company_employees'];
        $newCustomer->class = 'Bussiness';
        $newCustomer->save();

        $newBilling = new Billing();
        $newBilling->id = $validator1->validated()['uuid'];
        $newBilling->billing_name = $validator2->validated()['billing_name'];
        $newBilling->billing_contact = $validator2->validated()['billing_phone'];
        $newBilling->billing_email = $validator2->validated()['billing_email'];
        $newBilling->save();

        $newTechnical = new Technical();
        $newTechnical->id = $validator1->validated()['uuid'];
        $newTechnical->service_package = $validator3->validated()['technical_service'];
        $newTechnical->id_photo_url = $tujuan_upload . '/' . $fileIdentityPhoto->getClientOriginalName();
        $newTechnical->selfie_id_photo_url = $tujuan_upload . '/' . $fileSelfiePhoto->getClientOriginalName();
        $newTechnical->save();

        return redirect()->to('new-member')->with('message', 'Selamat, Anda Berhasil Registrasi.');
    }
}
