@extends('installer.layout')

@section('content')
<div style="text-align: center;">
    <div style="font-size: 64px; margin-bottom: 20px;">🎉</div>
    <h2 style="font-size: 28px; color: #333; margin-bottom: 15px;">Welcome to Zyrocart!</h2>
    <p style="font-size: 16px; color: #666; line-height: 1.6; margin-bottom: 30px;">
        Thank you for choosing Zyrocart for your e-commerce needs. This wizard will guide you through the installation process step by step.
    </p>

    <div style="background: #f8f9fa; padding: 30px; border-radius: 8px; margin: 30px 0; text-align: left;">
        <h3 style="font-size: 20px; color: #333; margin-bottom: 20px;">📋 Before You Begin</h3>
        <p style="font-size: 14px; color: #666; margin-bottom: 15px;">Please make sure you have the following information ready:</p>
        
        <ul style="list-style: none; padding: 0;">
            <li style="padding: 10px 0; border-bottom: 1px solid #e9ecef;">
                <strong style="color: #333;">✓ Database Credentials</strong>
                <span style="color: #666; font-size: 14px; display: block; margin-top: 5px;">Database name, username, and password</span>
            </li>
            <li style="padding: 10px 0; border-bottom: 1px solid #e9ecef;">
                <strong style="color: #333;">✓ Admin Information</strong>
                <span style="color: #666; font-size: 14px; display: block; margin-top: 5px;">Your name, email, and desired password</span>
            </li>
            <li style="padding: 10px 0; border-bottom: 1px solid #e9ecef;">
                <strong style="color: #333;">✓ Server Requirements</strong>
                <span style="color: #666; font-size: 14px; display: block; margin-top: 5px;">PHP 8.1+, MySQL 5.7+, and required extensions</span>
            </li>
            <li style="padding: 10px 0;">
                <strong style="color: #333;">✓ File Permissions</strong>
                <span style="color: #666; font-size: 14px; display: block; margin-top: 5px;">Write access to storage and bootstrap/cache directories</span>
            </li>
        </ul>
    </div>

    <div style="background: #d1ecf1; border-left: 4px solid #0c5460; padding: 20px; border-radius: 6px; text-align: left; margin-top: 20px;">
        <strong style="color: #0c5460; font-size: 14px;">ℹ️ Installation Time</strong>
        <p style="color: #0c5460; font-size: 14px; margin-top: 8px; margin-bottom: 0;">
            The entire installation process typically takes 5-10 minutes to complete.
        </p>
    </div>
</div>
@endsection

@section('footer')
<div></div>
<a href="{{ route('install.requirements') }}" class="btn btn-primary">Get Started →</a>
@endsection