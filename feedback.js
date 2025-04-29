// Feedback.js
document.addEventListener('DOMContentLoaded', () => {
    const feedbackForm = document.getElementById('feedbackForm');
    const feedbackInput = document.getElementById('feedbackInput');
    const feedbackList = document.getElementById('feedbackList');
  
    // Handle form submission
    feedbackForm.addEventListener('submit', (e) => {
      e.preventDefault();
  
      const feedbackText = feedbackInput.value.trim();
      if (feedbackText) {
        addFeedback(feedbackText);
        feedbackInput.value = ''; // Clear the input
      }
    });
  
    // Add feedback to the list
    function addFeedback(text) {
      const feedbackItem = document.createElement('div');
      feedbackItem.classList.add('feedback-item');
      feedbackItem.textContent = text;
      feedbackList.prepend(feedbackItem); // Add to the top of the list
    }
  });
  