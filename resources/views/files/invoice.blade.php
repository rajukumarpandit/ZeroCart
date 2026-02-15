@extends('Layout.layout')
@section('content')
    <div class="page-header mb-4 no-print">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="page-title mb-2">Invoice</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="dashboard.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item active">Invoice</li>
                    </ol>
                </nav>
            </div>
            <div>
                <button class="btn btn-outline-primary me-2" onclick="window.print()">
                    <i class="bi bi-printer me-2"></i>Print
                </button>
                <button class="btn btn-primary">
                    <i class="bi bi-download me-2"></i>Download PDF
                </button>
            </div>
        </div>
    </div>

    <div class="invoice-box">
        <!-- Invoice Header -->
        <div class="invoice-header">
            <div>
                <div class="invoice-logo">
                    <i class="bi bi-lightning-charge-fill"></i> Emoce
                </div>
                <p class="mb-1">123 Business Street</p>
                <p class="mb-1">San Francisco, CA 94102</p>
                <p class="mb-1">support@emoce.com</p>
                <p class="mb-0">(555) 123-4567</p>
            </div>
            <div class="text-end">
                <h2 class="mb-3">INVOICE</h2>
                <p class="mb-1"><strong>Invoice #:</strong> INV-2024-001</p>
                <p class="mb-1"><strong>Date:</strong> January 29, 2024</p>
                <p class="mb-3"><strong>Due Date:</strong> February 28, 2024</p>
                <span class="invoice-status paid">PAID</span>
            </div>
        </div>

        <!-- Bill To / Ship To -->
        <div class="invoice-details">
            <div>
                <h5 class="mb-3">Bill To:</h5>
                <p class="mb-1"><strong>Acme Corporation</strong></p>
                <p class="mb-1">John Smith</p>
                <p class="mb-1">456 Customer Avenue</p>
                <p class="mb-1">New York, NY 10001</p>
                <p class="mb-0">john.smith@acme.com</p>
            </div>
            <div>
                <h5 class="mb-3">Ship To:</h5>
                <p class="mb-1"><strong>Acme Corporation</strong></p>
                <p class="mb-1">789 Delivery Road</p>
                <p class="mb-1">New York, NY 10001</p>
                <p class="mb-1">United States</p>
            </div>
        </div>

        <!-- Invoice Items -->
        <div class="invoice-table">
            <table>
                <thead>
                    <tr>
                        <th style="width: 50%;">Description</th>
                        <th style="width: 15%;">Quantity</th>
                        <th style="width: 15%;">Unit Price</th>
                        <th style="width: 20%; text-align: right;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <strong>Professional Plan - Monthly</strong>
                            <p class="text-muted small mb-0">Access to all premium features</p>
                        </td>
                        <td>1</td>
                        <td>$29.00</td>
                        <td style="text-align: right;">$29.00</td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Additional Storage (100GB)</strong>
                            <p class="text-muted small mb-0">Extra cloud storage space</p>
                        </td>
                        <td>1</td>
                        <td>$10.00</td>
                        <td style="text-align: right;">$10.00</td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Premium Support</strong>
                            <p class="text-muted small mb-0">24/7 priority customer support</p>
                        </td>
                        <td>1</td>
                        <td>$15.00</td>
                        <td style="text-align: right;">$15.00</td>
                    </tr>
                    <tr>
                        <td>
                            <strong>API Access</strong>
                            <p class="text-muted small mb-0">Unlimited API calls</p>
                        </td>
                        <td>1</td>
                        <td>$20.00</td>
                        <td style="text-align: right;">$20.00</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Invoice Total -->
        <div class="invoice-total">
            <div class="invoice-total-row">
                <span>Subtotal:</span>
                <span>$74.00</span>
            </div>
            <div class="invoice-total-row">
                <span>Tax (10%):</span>
                <span>$7.40</span>
            </div>
            <div class="invoice-total-row">
                <span>Discount:</span>
                <span>-$5.00</span>
            </div>
            <div class="invoice-total-row invoice-total-final">
                <span>Total:</span>
                <span>$76.40</span>
            </div>
        </div>

        <!-- Payment Information -->
        <div class="mt-5">
            <h5 class="mb-3">Payment Information</h5>
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-1"><strong>Payment Method:</strong></p>
                    <p class="mb-3">Credit Card (•••• •••• •••• 4242)</p>
                    <p class="mb-1"><strong>Transaction ID:</strong></p>
                    <p class="mb-0">TXN-2024-789456123</p>
                </div>
                <div class="col-md-6">
                    <p class="mb-1"><strong>Payment Date:</strong></p>
                    <p class="mb-3">January 29, 2024</p>
                    <p class="mb-1"><strong>Payment Status:</strong></p>
                    <p class="mb-0"><span class="badge bg-success">Paid in Full</span></p>
                </div>
            </div>
        </div>

        <!-- Notes -->
        <div class="mt-5">
            <h5 class="mb-3">Notes</h5>
            <p class="text-muted">Thank you for your business! We appreciate your prompt payment. If you have any questions
                concerning this invoice, please contact our billing department at billing@emoce.com or call us at (555)
                123-4567.</p>
        </div>

        <!-- Terms & Conditions -->
        <div class="mt-4">
            <h6 class="mb-2">Terms & Conditions</h6>
            <p class="text-muted small">
                1. Payment is due within 30 days of invoice date.<br>
                2. Late payments may incur a 5% monthly interest charge.<br>
                3. All prices are in USD unless otherwise stated.<br>
                4. Refunds are subject to our refund policy terms.
            </p>
        </div>

        <!-- Footer -->
        <div class="invoice-footer">
            <p class="mb-1">This is a computer-generated invoice and does not require a signature.</p>
            <p class="mb-0">For questions, contact us at support@emoce.com</p>
        </div>
    </div>
@endsection
