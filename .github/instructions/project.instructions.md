---
description: Project overview and requirements for the SAIT Student Survey application
applyTo: '**'
---

# SAIT Student Survey Project

A mobile-first survey application for students at SAIT university.

The objective is to build a light mobile-first web application to collect student idea about how we can make life as a sait student better

## Project Requirements

### Home Page
- Page to view student propositions from other users
- Guest users can see all posts exactly like connected users
- Guest users cannot post or vote on propositions (If the try, a popup appear proposing them to sign in)
- Clear call-to-action for registration/login

### Detail Page
- Comprehensive project information page
- Overview of the AI assistant project
- Current features and future development plans
- Ways for students to get involved

### Authentication System
- Login page with message: "Be one of the first to Join the project"
- Google OAuth authentication
- Email and password authentication
- Nickname requirement during registration
- User registration and login functionality

### Propositions Page
- Page to view student propositions for the app
- Authenticated users can submit new propositions
- Upvoting and downvoting functionality (authenticated users only)
- Animations for voting interactions
- Sorting options (top voted, most recent)
- Display of proposer's nickname
- Admin-only view of proposer's email
- Status system for propositions (zero, one, two, ready, not possible)
- Status are recongized by thier color
- at the bottom of the page there is a text input for posting our own message
- use pusher to broadcast the event of posting and upvoting or downvoting

### Admin Features
- Admin user role with special privileges
- Ability to update proposition
- User identification capabilities (admin only)

## Technical Implementation

### Backend
- Laravel PHP framework
- MySQL database
- Laravel Breeze for authentication scaffolding
- Socialite for Google OAuth integration

### Frontend
- Tailwind CSS for styling
- Responsive design
- Interactive JavaScript components

### Database Seeding
- 50 users (1 admin, 10 without accounts, 39 regular users)
- 3 propositions per user (150 total)
- Name suggestions for naming the AI assistant
- Random upvotes and downvotes for testing

## Progress Tracking

(Nothing to say for now.)

## Project Structure
- Laravel backend with MySQL database
- Tailwind CSS for frontend styling
- Laravel Breeze for authentication
- Socialite for Google OAuth
- MVC architecture pattern

## Testing Data
The database has been seeded with:
- 50 users (1 admin, 10 without accounts, 39 regular users)
- 150 propositions (3 per user)
- Random votes on propositions

## Typical user journey
- going to the url and seeing a landing page with sait colors and sait photos
- clicking a button to see the proposition page full of ideas written by other student
- attemping to upvoting and downvoting some ideas or creating his own
- seeing a popup asking him to create an account
- creating an account with google
- seeing the proposition page full of content created by other users
- upvoting and downvoting some ideas
- creating his own (waiting one day to create another proposition (to avoid spam))

## Some instruction
1. do not run "php artisan serve" (it is already running)
2. do not run "npm run dev" (it is already running)
3. use good laravel practice (Laravel12)
4. do not self commit on git.

## Clean Commit Process
When the user asks to "make a clean commit", follow this comprehensive cleanup process:

### 1. Security Analysis
- Run security scanning tools (like Codacy with Trivy) to identify vulnerabilities
- Check for exposed API keys, secrets, or sensitive data in code
- Verify proper input validation and sanitization
- Review authentication and authorization mechanisms

### 2. Code Cleanup
- Remove all console.log(), var_dump(), dd(), dump() and other debug statements
- Remove commented-out code blocks that are no longer needed
- Remove temporary files and unused imports
- Clean up unnecessary whitespace and formatting inconsistencies
- Remove any TODO comments that have been completed

### 3. File Organization
- Remove test files that were created during development but not needed in production
- Clean up temporary or backup files (*.bak, *.tmp, etc.)
- Ensure proper file structure and organization
- Remove empty directories or unused assets

### 4. Code Quality
- Check for unused variables, functions, and classes
- Ensure consistent code formatting
- Verify proper error handling
- Remove redundant or duplicate code

### 5. Documentation
- Update comments to reflect current functionality
- Ensure README and documentation are current
- Remove outdated or misleading comments

### 6. Final Verification
- Run basic functionality tests to ensure nothing is broken
- Verify all routes and main features still work
- Check that no critical functionality was accidentally removed

Only after completing ALL these steps should the commit be made with a clear, descriptive commit message.