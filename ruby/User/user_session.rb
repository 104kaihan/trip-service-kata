require_relative '../../ruby/еxceptions/dependend_class_call_during_unit_test_exception'

class UserSession
    @@user_session = UserSession.new

    def get_instance
        @@user_session
    end

    def is_user_logged_in(user)
        raise DependendClassCallDuringUnitTestException.new('UserSession.IsUserLoggedIn() should not be called in an unit test')
    end

    def get_logged_user
        raise DependendClassCallDuringUnitTestException.new('UserSession.GetLoggedUser() should not be called in an unit test')
    end

    private_class_method :new
end