<?php

namespace Doctrine\DBAL\Driver\OCI8;

use Doctrine\DBAL\Driver\AbstractOracleDriver;

use const OCI_NO_AUTO_COMMIT;

/**
 * A Doctrine DBAL driver for the Oracle OCI8 PHP extensions.
 */
class Driver extends AbstractOracleDriver
{
    /**
     * {@inheritdoc}
     */
    public function connect(array $params, $username = null, $password = null, array $driverOptions = [])
    {
        return new OCI8Connection(
            (string) $username,
            (string) $password,
            $this->_constructDsn($params),
            $params['charset'] ?? '',
            $params['sessionMode'] ?? OCI_NO_AUTO_COMMIT,
            $params['persistent'] ?? false
        );
    }

    /**
     * Constructs the Oracle DSN.
     *
     * @param mixed[] $params
     *
     * @return string The DSN.
     */
    protected function _constructDsn(array $params)
    {
        return $this->getEasyConnectString($params);
    }

    /**
     * {@inheritdoc}
     *
     * @deprecated
     */
    public function getName()
    {
        return 'oci8';
    }
}
