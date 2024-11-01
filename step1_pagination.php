<?php
$currentStep = isset($currentStep) ? $currentStep : 1; // Default to step 1 if not set

$stepNames = [
    1 => 'Life Goals',
    2 => 'Core Values',
    3 => 'Vision Statement'
];
?>

<style>
.pagination-header {
    text-align: center; /* Center align the pagination */
    margin: 20px 0; /* Add some margin for spacing */
}

.pagination {
    list-style: none; /* Remove default list styling */
    padding: 0; /* Remove padding */
    display: inline-flex; /* Align items in a row */
    gap: 10px; /* Space between items */
}

.step {
    display: inline; /* Inline elements for steps */
}

.step a {
    text-decoration: none; /* Remove underline */
    padding: 10px 15px; /* Add padding */
    border-radius: 5px; /* Rounded corners */
    background-color: #f0f0f0; /* Light background */
    color: #333; /* Text color */
    transition: background-color 0.3s; /* Smooth background transition */
}

.step a:hover {
    background-color: #ddd; /* Darker background on hover */
}

.step.active a {
    background-color: #007bff; /* Highlight color for active step */
    color: white; /* White text for active step */
}

</style>

<div class="pagination-header">
    <ul class="pagination">
        <?php foreach ($stepNames as $step => $name): ?>
            <li class="step <?php echo $currentStep === $step ? 'active' : ''; ?>">
                <a href="step1-<?php echo $step; ?>.php"><?php echo $name; ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>