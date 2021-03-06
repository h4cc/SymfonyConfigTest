<?php

namespace Matthias\SymfonyConfigTest\PhpUnit;

/**
 * Extend your test case from this abstract class to test a class that implements
 * Symfony\Component\Config\Definition\ConfigurationInterface
 */
abstract class AbstractConfigurationTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * Return the instance of ConfigurationInterface that should be used by the
     * Configuration-specific assertions in this test-case
     *
     * @return \Symfony\Component\Config\Definition\ConfigurationInterface
     */
    abstract protected function getConfiguration();

    /**
     * Assert that the given configuration values are invalid.
     *
     * Optionally provide (part of) the exception message that you expect to receive.
     *
     * @param array $configurationValues
     * @param string|null $expectedMessage
     */
    protected function assertConfigurationIsInvalid(array $configurationValues, $expectedMessage = null)
    {
        self::assertThat(
            $configurationValues,
            new ConfigurationValuesAreInvalidConstraint(
                $this->getConfiguration(),
                $expectedMessage
            )
        );
    }

    /**
     * Assert that the given configuration values, when processed, will equal to the given array
     *
     * @param array $configurationValues
     * @param array $expectedProcessedConfiguration
     */
    protected function assertProcessedConfigurationEquals(
        array $configurationValues,
        array $expectedProcessedConfiguration
    ) {
        self::assertThat(
            $expectedProcessedConfiguration,
            new ProcessedConfigurationEqualsConstraint(
                $this->getConfiguration(),
                $configurationValues
            )
        );
    }
}
