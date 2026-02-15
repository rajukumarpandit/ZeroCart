@extends('installer.layout')

@section('content')
<div style="text-align: center;">
    <div style="font-size: 80px; margin-bottom: 20px;">🎉</div>
    <h2 style="font-size: 32px; color: #333; margin-bottom: 15px;">Installation Complete!</h2>
    <p style="font-size: 16px; color: #666; line-height: 1.6; margin-bottom: 30px;">
        Congratulations! Zyrocart has been successfully installed on your server.
    </p>

    @if(session('admin'))
    <div style="background: #d4edda; border-left: 4px solid #28a745; padding: 25px; border-radius: 8px; text-align: left; margin: 30px 0;">
        <h3 style="font-size: 18px; color: #155724; margin-bottom: 15px;">📋 Your Admin Credentials</h3>
        <div style="background: white; padding: 15px; border-radius: 6px; margin-bottom: 10px;">
            <strong style="color: #333;">Email:</strong>
            <code style="background: #f8f9fa; padding: 4px 8px; border-radius: 4px; margin-left: 10px; font-size: 14px;">{{ session('admin')['email'] }}</code>
        </div>
        <div style="background: white; padding: 15px; border-radius: 6px;">
            <strong style="color: #333;">Password:</strong>
            <span style="margin-left: 10px; color: #666; font-size: 14px;">The password you set during installation</span>
        </div>
        <p style="color: #155724; font-size: 13px; margin-top: 15px; margin-bottom: 0;">
            ⚠️ Please save these credentials in a secure location. You'll need them to access the admin panel.
        </p>
    </div>
    @endif

    <div style="background: #f8f9fa; padding: 30px; border-radius: 8px; margin: 30px 0; text-align: left;">
        <h3 style="font-size: 20px; color: #333; margin-bottom: 20px;">🚀 What's Next?</h3>
        
        <div style="display: grid; grid-template-columns: 1fr; gap: 15px;">
            <div style="background: white; padding: 20px; border-radius: 6px; border-left: 4px solid #667eea;">
                <h4 style="font-size: 16px; color: #333; margin-bottom: 8px;">1. Delete Installation Files</h4>
                <p style="color: #666; font-size: 14px; margin: 0;">
                    For security reasons, please delete the <code style="background: #f8f9fa; padding: 2px 6px; border-radius: 3px;">/install</code> route and installer files from your server.
                </p>
            </div>

            <div style="background: white; padding: 20px; border-radius: 6px; border-left: 4px solid #28a745;">
                <h4 style="font-size: 16px; color: #333; margin-bottom: 8px;">2. Configure Your Store</h4>
                <p style="color: #666; font-size: 14px; margin: 0;">
                    Set up your store settings, payment gateways, shipping methods, and tax configurations.
                </p>
            </div>

            <div style="background: white; padding: 20px; border-radius: 6px; border-left: 4px solid #ffc107;">
                <h4 style="font-size: 16px; color: #333; margin-bottom: 8px;">3. Add Your Products</h4>
                <p style="color: #666; font-size: 14px; margin: 0;">
                    Start adding your products, categories, and build your product catalog.
                </p>
            </div>

            <div style="background: white; padding: 20px; border-radius: 6px; border-left: 4px solid #17a2b8;">
                <h4 style="font-size: 16px; color: #333; margin-bottom: 8px;">4. Customize Your Theme</h4>
                <p style="color: #666; font-size: 14px; margin: 0;">
                    Personalize your store's appearance to match your brand identity.
                </p>
            </div>
        </div>
    </div>

    <div style="background: #fff3cd; border-left: 4px solid #ffc107; padding: 20px; border-radius: 8px; text-align: left; margin: 20px 0;">
        <h4 style="font-size: 16px; color: #856404; margin-bottom: 10px;">⚡ Important Security Note</h4>
        <p style="color: #856404; font-size: 14px; margin: 0;">
            Make sure to remove or disable the installation routes in your <code style="background: #f8f9fa; padding: 2px 6px; border-radius: 3px;">routes/web.php</code> file to prevent unauthorized access to the installer.
        </p>
    </div>

    <div style="background: #d1ecf1; border-left: 4px solid #0c5460; padding: 20px; border-radius: 8px; text-align: left; margin: 20px 0;">
        <h4 style="font-size: 16px; color: #0c5460; margin-bottom: 10px;">📚 Need Help?</h4>
        <p style="color: #0c5460; font-size: 14px; margin-bottom: 10px;">
            Check out our documentation and resources:
        </p>
        <ul style="color: #0c5460; font-size: 14px; margin: 0; padding-left: 20px;">
            <li>User Guide & Documentation</li>
            <li>Video Tutorials</li>
            <li>Community Forum</li>
            <li>Support Tickets</li>
        </ul>
    </div>

    <div style="margin-top: 40px; display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
        <a href="{{ url('/') }}" class="btn btn-secondary" style="text-decoration: none;">
            🏠 Visit Homepage
        </a>
        <a href="{{ route('admin.login') }}" class="btn btn-primary" style="text-decoration: none;">
            🎯 Go to Admin Panel
        </a>
    </div>

    <div style="margin-top: 30px; padding-top: 30px; border-top: 2px solid #e9ecef;">
        <p style="color: #6c757d; font-size: 14px; margin-bottom: 10px;">
            Thank you for choosing Zyrocart! 🎊
        </p>
        <p style="color: #6c757d; font-size: 13px; margin: 0;">
            We hope you build an amazing online store. Happy selling! 🚀
        </p>
    </div>
</div>
@endsection

@section('styles')
<style>
    code {
        font-family: 'Courier New', monospace;
        font-size: 13px;
    }
    
    @media (max-width: 768px) {
        .installer-content {
            padding: 20px !important;
        }
        
        h2 {
            font-size: 24px !important;
        }
    }
</style>
@endsection

@section('scripts')
<script>
    // Confetti animation (optional - celebratory effect)
    document.addEventListener('DOMContentLoaded', function() {
        // You can add confetti or celebration animation library here
        console.log('Installation completed successfully! 🎉');
        
        // Show a brief welcome message
        setTimeout(function() {
            const welcomeMsg = document.createElement('div');
            welcomeMsg.style.cssText = `
                position: fixed;
                bottom: 20px;
                right: 20px;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                padding: 15px 25px;
                border-radius: 8px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.2);
                font-size: 14px;
                z-index: 1000;
                animation: slideIn 0.5s ease-out;
            `;
            welcomeMsg.innerHTML = '🎉 Welcome to Zyrocart!';
            document.body.appendChild(welcomeMsg);
            
            setTimeout(function() {
                welcomeMsg.style.animation = 'slideOut 0.5s ease-out';
                setTimeout(function() {
                    welcomeMsg.remove();
                }, 500);
            }, 3000);
        }, 500);
    });
    
    // Add animations
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideIn {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        @keyframes slideOut {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(400px);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);
</script>
@endsection