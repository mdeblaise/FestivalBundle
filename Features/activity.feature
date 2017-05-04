@reset-schema

Feature: Activity

    Scenario: No activity
        Given I have no activity
        When I ask for activities list
        Then I should see 0 activity

    Scenario: Test the chain lister
        Given I am visitor
        Then I have no activity
        And there are the following fake activities
            | title         | descriptif | date       | status |
            | FakeActivity1 | blabla 	 | 2016/08/16 | v 	   |
            | FakeActivity2 | blabla 	 | 2016/08/16 | v 	   |
            | FakeActivity3 | blabla 	 | 2016/08/16 | v 	   |
            | FakeActivity4 | blabla 	 | 2016/08/16 | v 	   |
            | FakeActivity5 | blabla 	 | 2016/08/16 | v 	   |
        When I ask for activities list
        Then I received a list of fake activity
        And I should see 5 activities
        And I should see the title of activity 4 is equals to 'FakeActivity4'

        Given the following CardActivities
            | uuid |
            | 00000000-0000-4444-aaaa-000000000000 |
            | 11111111-1111-4444-aaaa-111111111111 |
            | 22222222-2222-4444-aaaa-222222222222 |
            | 33333333-1111-4444-aaaa-333333333333 |
            | 44444444-1111-4444-aaaa-444444444444 |
            | 55555555-1111-4444-aaaa-555555555555 |
            | 66666666-1111-4444-aaaa-666666666666 |
            | 77777777-1111-4444-aaaa-777777777777 |
            | 88888888-1111-4444-aaaa-888888888888 |
            | 99999999-1111-4444-aaaa-999999999999 |
        And the following activities:
            | title     | descriptif  | status | card                                 | type | univers | edition |
            | Activity1 | descriptif1 | v      | 00000000-0000-4444-aaaa-000000000000 | conf | gk      | 2017    |
            | Activity2 | descriptif2 | v      | 11111111-1111-4444-aaaa-111111111111 | conf | gk      | 2017    |
            | Activity3 | descriptif3 | v      | 22222222-2222-4444-aaaa-222222222222 | conf | gk      | 2017    |
            | Activity4 | descriptif4 | v      | 33333333-1111-4444-aaaa-333333333333 | conf | gk      | 2017    |
            | Activity5 | descriptif4 | v      | 44444444-1111-4444-aaaa-444444444444 | conf | gk      | 2017    |
            | Activity6 | descriptif6 | v      | 55555555-1111-4444-aaaa-555555555555 | conf | gk      | 2017    |
            | Activity7 | descriptif7 | v      | 66666666-1111-4444-aaaa-666666666666 | conf | gk      | 2017    |
        Given I prepare the request
        When I ask for activities list
        Then I received a list of real activity
        And I should see 7 activities
        And I should see the title of activity 1 is equals to 'Activity1'
        And I should see the title of activity 2 is equals to 'Activity2'
        And I should see the title of activity 3 is equals to 'Activity3'
        And I should see the title of activity 4 is equals to 'Activity4'

    Scenario: Test 3
        Given the following CardActivities
            | uuid                                 |
            | 00000000-0000-4444-aaaa-000000000000 |
            | 11111111-1111-4444-aaaa-111111111111 |
            | 22222222-2222-4444-aaaa-222222222222 |
            | 33333333-3333-4444-aaaa-333333333333 |
        And the following activities:
            | title      | status | card                                 | type | univers | edition |
            | Activity1  | v      | 00000000-0000-4444-aaaa-000000000000 | conf | gk      | 2017    |
            | Activity2  | v      | 11111111-1111-4444-aaaa-111111111111 | conf | gk      | 2017    |
            | Activity3  | v      | 22222222-2222-4444-aaaa-222222222222 | conf | gk      | 2017    |
            | Activity4  | d      | 22222222-2222-4444-aaaa-222222222222 | conf | gk      | 2017    |
            | Activity5  | c      | 33333333-3333-4444-aaaa-333333333333 | conf | gk      | 2017    |
        When I ask for activities list
        Then I should see 3 activity
        And I should see the title of activity 1 is equals to 'Activity1'
        And I should see the title of activity 2 is equals to 'Activity2'
        And I should see the title of activity 3 is equals to 'Activity3'
        Given I am admin
        When I ask for activities list
        Then I should see 4 activities
        And I should see the title of activity 1 is equals to 'Activity1'
        And I should see the title of activity 2 is equals to 'Activity2'
        And I should see the title of activity 3 is equals to 'Activity3'
        And I should see the uuid of activity 4 is equals to '33333333-3333-4444-aaaa-333333333333'