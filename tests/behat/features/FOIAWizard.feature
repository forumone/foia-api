@foia_wizard
Feature: Testing the FOIA Wizard configuration settings form

  @api
  Scenario: Settings form saves and displays the correct values
    Given I am logged in as a user with the "administrator" role
    When I am 'admin/config/system/foia-wizard'
    And I fill in "Introduction Slide" with "Example introduction message"
    And I press "Save configuration"
    Then I should see "The configuration options have been saved."
    And I am on 'admin/config/system/foia-wizard'
    And the "Introduction Slide" field should contain "Example introduction message"
