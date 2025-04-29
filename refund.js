// Refund.js
document.addEventListener('DOMContentLoaded', () => {
    const refundForm = document.getElementById('refundForm');
    const refundFeedback = document.getElementById('refundFeedback');
  
    // Handle form submission
    refundForm.addEventListener('submit', (e) => {
      e.preventDefault();
  
      const orderNumber = document.getElementById('orderNumber').value.trim();
      const reason = document.getElementById('reason').value.trim();
  
      if (orderNumber && reason) {
        displayRefundFeedback(orderNumber);
        refundForm.reset(); // Clear the form fields
      } else {
        alert('Please fill out all fields before submitting.');
      }
    });
  
    // Display feedback
    function displayRefundFeedback(orderNumber) {
      refundFeedback.textContent = `Your refund request for Order #${orderNumber} has been submitted. We will process it within 3-5 business days.`;
    }
  });
  