<?PHP

class rex_yform_validate_ycom_auth_password extends rex_yform_validate_abstract
{
    public function enterObject()
    {
        $Object = $this->getValueObject();

        $user = rex_ycom_auth::getUser();
        if (!$user) {
            // no user available -> error
            $this->params['warning'][$Object->getId()] = true;
            $this->params['warning_messages'][$Object->getId()] = $this->getElement(3);
            return;
        }

        $status = rex_ycom_auth::checkPassword($Object->getValue(), $user->getId());
        if (!$status) {
            // password wrong
            $this->params['warning'][$Object->getId()] = true;
            $this->params['warning_messages'][$Object->getId()] = $this->getElement(3);
            return;

        }

    }

    public function getDescription()
    {
        return 'ycom_auth_password -> validate|ycom_auth_password|pswfield|warning_message';
    }
}
