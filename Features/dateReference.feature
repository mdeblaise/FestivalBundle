Feature: DateReference

    Scenario: Test date
        Given I set the date to '2016-08-01 07:30:45'
        Then the date indicate '2016-08-01' in format 'Y-m-d'
        And the date indicate '07:30' in format 'H:i'
    