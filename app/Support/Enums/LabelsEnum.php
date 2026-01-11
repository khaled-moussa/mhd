<?php

namespace App\Support\Enums;

enum LabelsEnum: string
{
    // Steps
    case CONFIRM_PASSWORD = 'Confirm Password';
    case UPDATE_EMAIL     = 'Update Email';
    case VERIFY_CODE      = 'Verify Code';

    // Buttons
    case BUTTON_SUBMIT         = 'Submit';
    case BUTTON_CANCEL         = 'Cancel';
    
    // Messages
    case MESSAGE_SUCCESS       = 'Operation completed successfully';
    case MESSAGE_ERROR         = 'Something went wrong';

    // Add more global labels here...
}
