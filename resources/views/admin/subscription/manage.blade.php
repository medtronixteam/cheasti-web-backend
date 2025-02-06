@extends('layouts.app')
@section('title')
Subscription

@endsection

@section('content')
    <h4>Subscriptions</h4>

    <div class="subscription-form">
        <h5>Add / Update Packages</h5>

        <div class="row mb-3">
            <div class="col-12 col-md-6">
                <label for="plans-dropdown">Select Package</label>
                <select id="plans-dropdown" class="form-control">
                    <option value="">Select Package</option>
                    @foreach($plans as $plan)
                        <option value="{{ $plan->id }}">{{ $plan->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-md-6">
                <label for="price">Monthly Price</label>
                <input type="number" id="price" class="form-control" step="0.01">
            </div>
        </div><div class="row mb-3">
            <div class="col-12">
                <label for="package_id">Package ID</label>
                <input type="text" id="package_id" name="package_id" class="form-control">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12">
                <label for="description">Description</label>
                <textarea id="description" class="form-control" rows="3"></textarea>
            </div>
        </div>



        <div class="row">
            <div class="col-12">
                <h6>Include Options</h6>
                <div class="row">
                    @foreach(['invoices', 'notes', 'planner_scheduler', 'editor_software', 'auto_content', 'multiple_platform_link', 'automation_cloud_data', 'auto_scheduler', 'admin_owner', 'automation'] as $feature)
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-check">
                                <input class="form-check-input feature-checkbox" type="checkbox" id="{{ $feature }}" name="{{ $feature }}">
                                <label class="form-check-label" for="{{ $feature }}">
                                    {{ ucfirst(str_replace('_', ' ', $feature)) }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Update button and hidden form for update -->
        <button id="updateButton" class="btn btn-primary mt-3">Update</button>
        <form id="updateForm" method="POST" style="display: none;">
            @csrf
            @method('PUT')
            <input type="hidden" id="planId" name="planId">
            <input type="hidden" id="priceInput" name="price">
            <input type="hidden" id="descriptionInput" name="description">
            <input type="hidden" id="packageIdInput" name="package_id">
            @foreach(['invoices', 'notes', 'planner_scheduler', 'editor_software', 'auto_content', 'multiple_platform_link', 'automation_cloud_data', 'auto_scheduler', 'admin_owner', 'automation'] as $feature)
                <input type="hidden" id="{{ $feature }}Input" name="{{ $feature }}">
            @endforeach
        </form>
    </div>

    <script>
        // JavaScript to handle plan selection and update
        document.getElementById('plans-dropdown').addEventListener('change', function() {
            var planId = this.value;

            // Populate the fields with selected plan data
            var selectedPlan = @json($plans);
            var selected = selectedPlan.find(plan => plan.id == planId);
            if (selected) {
                document.getElementById('price').value = selected.price;
                document.getElementById('description').value = selected.description;
                document.getElementById('package_id').value = selected.package_id; // Set package_id field

                // Set checkboxes based on selected plan features
                var features = ['invoices', 'notes', 'planner_scheduler', 'editor_software', 'auto_content', 'multiple_platform_link', 'automation_cloud_data', 'auto_scheduler', 'admin_owner', 'automation'];
                features.forEach(function(feature) {
                    document.getElementById(feature).checked = selected[feature] == 1;
                });
            } else {
                // Clear fields if no plan is selected
                document.getElementById('price').value = '';
                document.getElementById('description').value = '';
                document.getElementById('package_id').value = ''; // Clear package_id field
                features.forEach(function(feature) {
                    document.getElementById(feature).checked = false;
                });
            }
        });

        // Update button click handler
        document.getElementById('updateButton').addEventListener('click', function() {
            var planId = document.getElementById('plans-dropdown').value;
            document.getElementById('planId').value = planId;
            document.getElementById('priceInput').value = document.getElementById('price').value;
            document.getElementById('descriptionInput').value = document.getElementById('description').value;
            document.getElementById('packageIdInput').value = document.getElementById('package_id').value; // Set package_id here

            var features = ['invoices', 'notes', 'planner_scheduler', 'editor_software', 'auto_content', 'multiple_platform_link', 'automation_cloud_data', 'auto_scheduler', 'admin_owner', 'automation'];
            features.forEach(function(feature) {
                document.getElementById(feature + 'Input').value = document.getElementById(feature).checked ? 1 : 0;
            });

            document.getElementById('updateForm').action = '/admin/subscription/' + planId;
            document.getElementById('updateForm').submit();
        });
    </script>

    <style>
        .subscription-form {
            padding: 20px;
        }

        .subscription-form h5 {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .subscription-form label {
            display: block;
            font-weight: bold;
        }

        .subscription-form .form-control {
            margin-top: 5px;
        }

        .subscription-form button {
            margin-top: 20px;
        }
    </style>
@endsection
