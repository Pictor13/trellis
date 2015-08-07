<?php

namespace Trellis\Runtime\Attribute\Image;

use Trellis\Runtime\Attribute\Attribute;
use Trellis\Runtime\Attribute\HandlesFileInterface;
use Trellis\Runtime\Attribute\HasComplexValueInterface;
use Trellis\Runtime\Validator\Result\IncidentInterface;
use Trellis\Runtime\Validator\Rule\RuleList;

/**
 * An image (metadata including a location).
 */
class ImageAttribute extends Attribute implements HandlesFileInterface, HasComplexValueInterface
{
    // restrict meta_data to certain keys or values or key-value pairs
    const OPTION_META_DATA_ALLOWED_KEYS                   = ImageRule::OPTION_META_DATA_ALLOWED_KEYS;
    const OPTION_META_DATA_ALLOWED_VALUES                 = ImageRule::OPTION_META_DATA_ALLOWED_VALUES;
    const OPTION_META_DATA_ALLOWED_PAIRS                  = ImageRule::OPTION_META_DATA_ALLOWED_PAIRS;
    /**
     * Option to define that meta_data values must be of a certain scalar type.
     */
    const OPTION_META_DATA_VALUE_TYPE                     = ImageRule::OPTION_META_DATA_VALUE_TYPE;
    const META_DATA_VALUE_TYPE_BOOLEAN                    = ImageRule::META_DATA_VALUE_TYPE_BOOLEAN;
    const META_DATA_VALUE_TYPE_INTEGER                    = ImageRule::META_DATA_VALUE_TYPE_INTEGER;
    const META_DATA_VALUE_TYPE_FLOAT                      = ImageRule::META_DATA_VALUE_TYPE_FLOAT;
    const META_DATA_VALUE_TYPE_SCALAR                     = ImageRule::META_DATA_VALUE_TYPE_SCALAR;
    const META_DATA_VALUE_TYPE_TEXT                       = ImageRule::META_DATA_VALUE_TYPE_TEXT;
    const OPTION_META_DATA_MAX_VALUE                      = ImageRule::OPTION_META_DATA_MAX_VALUE;
    const OPTION_META_DATA_MIN_VALUE                      = ImageRule::OPTION_META_DATA_MIN_VALUE;
    // text options for meta_data
    const OPTION_META_DATA_ALLOW_CRLF                     = ImageRule::OPTION_META_DATA_ALLOW_CRLF;
    const OPTION_META_DATA_ALLOW_TAB                      = ImageRule::OPTION_META_DATA_ALLOW_TAB;
    const OPTION_META_DATA_MAX_LENGTH                     = ImageRule::OPTION_META_DATA_MAX_LENGTH;
    const OPTION_META_DATA_MIN_LENGTH                     = ImageRule::OPTION_META_DATA_MIN_LENGTH;
    const OPTION_META_DATA_NORMALIZE_NEWLINES             = ImageRule::OPTION_META_DATA_NORMALIZE_NEWLINES;
    const OPTION_META_DATA_REJECT_INVALID_UTF8            = ImageRule::OPTION_META_DATA_REJECT_INVALID_UTF8;
    const OPTION_META_DATA_STRIP_CONTROL_CHARACTERS       = ImageRule::OPTION_META_DATA_STRIP_CONTROL_CHARACTERS;
    const OPTION_META_DATA_STRIP_DIRECTION_OVERRIDES      = ImageRule::OPTION_META_DATA_STRIP_DIRECTION_OVERRIDES;
    const OPTION_META_DATA_STRIP_INVALID_UTF8             = ImageRule::OPTION_META_DATA_STRIP_INVALID_UTF8;
    const OPTION_META_DATA_STRIP_NULL_BYTES               = ImageRule::OPTION_META_DATA_STRIP_NULL_BYTES;
    const OPTION_META_DATA_STRIP_ZERO_WIDTH_SPACE         = ImageRule::OPTION_META_DATA_STRIP_ZERO_WIDTH_SPACE;
    const OPTION_META_DATA_TRIM                           = ImageRule::OPTION_META_DATA_TRIM;
    // integer options for meta_data
    const OPTION_META_DATA_ALLOW_HEX                      = ImageRule::OPTION_META_DATA_ALLOW_HEX;
    const OPTION_META_DATA_ALLOW_OCTAL                    = ImageRule::OPTION_META_DATA_ALLOW_OCTAL;
    const OPTION_META_DATA_MAX_INTEGER_VALUE              = ImageRule::OPTION_META_DATA_MAX_INTEGER_VALUE;
    const OPTION_META_DATA_MIN_INTEGER_VALUE              = ImageRule::OPTION_META_DATA_MIN_INTEGER_VALUE;
    // float options for meta_data
    const OPTION_META_DATA_ALLOW_THOUSAND_SEPARATOR       = ImageRule::OPTION_META_DATA_ALLOW_THOUSAND_SEPARATOR;
    const OPTION_META_DATA_PRECISION_DIGITS               = ImageRule::OPTION_META_DATA_PRECISION_DIGITS;
    const OPTION_META_DATA_ALLOW_INFINITY                 = ImageRule::OPTION_META_DATA_ALLOW_INFINITY;
    const OPTION_META_DATA_ALLOW_NAN                      = ImageRule::OPTION_META_DATA_ALLOW_NAN;
    const OPTION_META_DATA_MAX_FLOAT_VALUE                = ImageRule::OPTION_META_DATA_MAX_FLOAT_VALUE;
    const OPTION_META_DATA_MIN_FLOAT_VALUE                = ImageRule::OPTION_META_DATA_MIN_FLOAT_VALUE;

    // copyright_url options
    const OPTION_COPYRIGHT_URL_MANDATORY                  = ImageRule::OPTION_COPYRIGHT_URL_MANDATORY;
    const OPTION_COPYRIGHT_URL_USE_IDN                    = ImageRule::OPTION_COPYRIGHT_URL_USE_IDN;
    const OPTION_COPYRIGHT_URL_CONVERT_HOST_TO_PUNYCODE   = ImageRule::OPTION_COPYRIGHT_URL_CONVERT_HOST_TO_PUNYCODE;
    const OPTION_COPYRIGHT_URL_ACCEPT_SUSPICIOUS_HOST     = ImageRule::OPTION_COPYRIGHT_URL_ACCEPT_SUSPICIOUS_HOST;
    const OPTION_COPYRIGHT_URL_CONVERT_SUSPICIOUS_HOST    = ImageRule::OPTION_COPYRIGHT_URL_CONVERT_SUSPICIOUS_HOST;
    const OPTION_COPYRIGHT_URL_DOMAIN_SPOOFCHECKER_CHECKS = ImageRule::OPTION_COPYRIGHT_URL_DOMAIN_SPOOFCHECKER_CHECKS;
    const OPTION_COPYRIGHT_URL_ALLOWED_SCHEMES            = ImageRule::OPTION_COPYRIGHT_URL_ALLOWED_SCHEMES;
    const OPTION_COPYRIGHT_URL_SCHEME_SEPARATOR           = ImageRule::OPTION_COPYRIGHT_URL_SCHEME_SEPARATOR;
    const OPTION_COPYRIGHT_URL_DEFAULT_SCHEME             = ImageRule::OPTION_COPYRIGHT_URL_DEFAULT_SCHEME;
    const OPTION_COPYRIGHT_URL_DEFAULT_USER               = ImageRule::OPTION_COPYRIGHT_URL_DEFAULT_USER;
    const OPTION_COPYRIGHT_URL_DEFAULT_PASS               = ImageRule::OPTION_COPYRIGHT_URL_DEFAULT_PASS;
    const OPTION_COPYRIGHT_URL_DEFAULT_PORT               = ImageRule::OPTION_COPYRIGHT_URL_DEFAULT_PORT;
    const OPTION_COPYRIGHT_URL_DEFAULT_PATH               = ImageRule::OPTION_COPYRIGHT_URL_DEFAULT_PATH;
    const OPTION_COPYRIGHT_URL_DEFAULT_QUERY              = ImageRule::OPTION_COPYRIGHT_URL_DEFAULT_QUERY;
    const OPTION_COPYRIGHT_URL_DEFAULT_FRAGMENT           = ImageRule::OPTION_COPYRIGHT_URL_DEFAULT_FRAGMENT;
    const OPTION_COPYRIGHT_URL_REQUIRE_USER               = ImageRule::OPTION_COPYRIGHT_URL_REQUIRE_USER;
    const OPTION_COPYRIGHT_URL_REQUIRE_PASS               = ImageRule::OPTION_COPYRIGHT_URL_REQUIRE_PASS;
    const OPTION_COPYRIGHT_URL_REQUIRE_PORT               = ImageRule::OPTION_COPYRIGHT_URL_REQUIRE_PORT;
    const OPTION_COPYRIGHT_URL_REQUIRE_PATH               = ImageRule::OPTION_COPYRIGHT_URL_REQUIRE_PATH;
    const OPTION_COPYRIGHT_URL_REQUIRE_QUERY              = ImageRule::OPTION_COPYRIGHT_URL_REQUIRE_QUERY;
    const OPTION_COPYRIGHT_URL_REQUIRE_FRAGMENT           = ImageRule::OPTION_COPYRIGHT_URL_REQUIRE_FRAGMENT;
    const OPTION_COPYRIGHT_URL_FORCE_USER                 = ImageRule::OPTION_COPYRIGHT_URL_FORCE_USER;
    const OPTION_COPYRIGHT_URL_FORCE_PASS                 = ImageRule::OPTION_COPYRIGHT_URL_FORCE_PASS;
    const OPTION_COPYRIGHT_URL_FORCE_HOST                 = ImageRule::OPTION_COPYRIGHT_URL_FORCE_HOST;
    const OPTION_COPYRIGHT_URL_FORCE_PORT                 = ImageRule::OPTION_COPYRIGHT_URL_FORCE_PORT;
    const OPTION_COPYRIGHT_URL_FORCE_PATH                 = ImageRule::OPTION_COPYRIGHT_URL_FORCE_PATH;
    const OPTION_COPYRIGHT_URL_FORCE_QUERY                = ImageRule::OPTION_COPYRIGHT_URL_FORCE_QUERY;
    const OPTION_COPYRIGHT_URL_FORCE_FRAGMENT             = ImageRule::OPTION_COPYRIGHT_URL_FORCE_FRAGMENT;
    const OPTION_COPYRIGHT_URL_ALLOW_CRLF                 = ImageRule::OPTION_COPYRIGHT_URL_ALLOW_CRLF;
    const OPTION_COPYRIGHT_URL_ALLOW_TAB                  = ImageRule::OPTION_COPYRIGHT_URL_ALLOW_TAB;
    const OPTION_COPYRIGHT_URL_MAX_LENGTH                 = ImageRule::OPTION_COPYRIGHT_URL_MAX_LENGTH;
    const OPTION_COPYRIGHT_URL_MIN_LENGTH                 = ImageRule::OPTION_COPYRIGHT_URL_MIN_LENGTH;
    const OPTION_COPYRIGHT_URL_NORMALIZE_NEWLINES         = ImageRule::OPTION_COPYRIGHT_URL_NORMALIZE_NEWLINES;
    const OPTION_COPYRIGHT_URL_REJECT_INVALID_UTF8        = ImageRule::OPTION_COPYRIGHT_URL_REJECT_INVALID_UTF8;
    const OPTION_COPYRIGHT_URL_STRIP_CONTROL_CHARACTERS   = ImageRule::OPTION_COPYRIGHT_URL_STRIP_CONTROL_CHARACTERS;
    const OPTION_COPYRIGHT_URL_STRIP_DIRECTION_OVERRIDES  = ImageRule::OPTION_COPYRIGHT_URL_STRIP_DIRECTION_OVERRIDES;
    const OPTION_COPYRIGHT_URL_STRIP_INVALID_UTF8         = ImageRule::OPTION_COPYRIGHT_URL_STRIP_INVALID_UTF8;
    const OPTION_COPYRIGHT_URL_STRIP_NULL_BYTES           = ImageRule::OPTION_COPYRIGHT_URL_STRIP_NULL_BYTES;
    const OPTION_COPYRIGHT_URL_STRIP_ZERO_WIDTH_SPACE     = ImageRule::OPTION_COPYRIGHT_URL_STRIP_ZERO_WIDTH_SPACE;
    const OPTION_COPYRIGHT_URL_TRIM                       = ImageRule::OPTION_COPYRIGHT_URL_TRIM;

    // location options
    const OPTION_LOCATION_ALLOW_CRLF                      = ImageRule::OPTION_LOCATION_ALLOW_CRLF;
    const OPTION_LOCATION_ALLOW_TAB                       = ImageRule::OPTION_LOCATION_ALLOW_TAB;
    const OPTION_LOCATION_MAX_LENGTH                      = ImageRule::OPTION_LOCATION_MAX_LENGTH;
    const OPTION_LOCATION_MIN_LENGTH                      = ImageRule::OPTION_LOCATION_MIN_LENGTH;
    const OPTION_LOCATION_NORMALIZE_NEWLINES              = ImageRule::OPTION_LOCATION_NORMALIZE_NEWLINES;
    const OPTION_LOCATION_REJECT_INVALID_UTF8             = ImageRule::OPTION_LOCATION_REJECT_INVALID_UTF8;
    const OPTION_LOCATION_STRIP_CONTROL_CHARACTERS        = ImageRule::OPTION_LOCATION_STRIP_CONTROL_CHARACTERS;
    const OPTION_LOCATION_STRIP_DIRECTION_OVERRIDES       = ImageRule::OPTION_LOCATION_STRIP_DIRECTION_OVERRIDES;
    const OPTION_LOCATION_STRIP_INVALID_UTF8              = ImageRule::OPTION_LOCATION_STRIP_INVALID_UTF8;
    const OPTION_LOCATION_STRIP_NULL_BYTES                = ImageRule::OPTION_LOCATION_STRIP_NULL_BYTES;
    const OPTION_LOCATION_STRIP_ZERO_WIDTH_SPACE          = ImageRule::OPTION_LOCATION_STRIP_ZERO_WIDTH_SPACE;
    const OPTION_LOCATION_TRIM                            = ImageRule::OPTION_LOCATION_TRIM;

    // title options
    const OPTION_TITLE_ALLOW_CRLF                         = ImageRule::OPTION_TITLE_ALLOW_CRLF;
    const OPTION_TITLE_ALLOW_TAB                          = ImageRule::OPTION_TITLE_ALLOW_TAB;
    const OPTION_TITLE_MAX_LENGTH                         = ImageRule::OPTION_TITLE_MAX_LENGTH;
    const OPTION_TITLE_MIN_LENGTH                         = ImageRule::OPTION_TITLE_MIN_LENGTH;
    const OPTION_TITLE_NORMALIZE_NEWLINES                 = ImageRule::OPTION_TITLE_NORMALIZE_NEWLINES;
    const OPTION_TITLE_REJECT_INVALID_UTF8                = ImageRule::OPTION_TITLE_REJECT_INVALID_UTF8;
    const OPTION_TITLE_STRIP_CONTROL_CHARACTERS           = ImageRule::OPTION_TITLE_STRIP_CONTROL_CHARACTERS;
    const OPTION_TITLE_STRIP_DIRECTION_OVERRIDES          = ImageRule::OPTION_TITLE_STRIP_DIRECTION_OVERRIDES;
    const OPTION_TITLE_STRIP_INVALID_UTF8                 = ImageRule::OPTION_TITLE_STRIP_INVALID_UTF8;
    const OPTION_TITLE_STRIP_NULL_BYTES                   = ImageRule::OPTION_TITLE_STRIP_NULL_BYTES;
    const OPTION_TITLE_STRIP_ZERO_WIDTH_SPACE             = ImageRule::OPTION_TITLE_STRIP_ZERO_WIDTH_SPACE;
    const OPTION_TITLE_TRIM                               = ImageRule::OPTION_TITLE_TRIM;

    // caption options
    const OPTION_CAPTION_ALLOW_CRLF                       = ImageRule::OPTION_CAPTION_ALLOW_CRLF;
    const OPTION_CAPTION_ALLOW_TAB                        = ImageRule::OPTION_CAPTION_ALLOW_TAB;
    const OPTION_CAPTION_MAX_LENGTH                       = ImageRule::OPTION_CAPTION_MAX_LENGTH;
    const OPTION_CAPTION_MIN_LENGTH                       = ImageRule::OPTION_CAPTION_MIN_LENGTH;
    const OPTION_CAPTION_NORMALIZE_NEWLINES               = ImageRule::OPTION_CAPTION_NORMALIZE_NEWLINES;
    const OPTION_CAPTION_REJECT_INVALID_UTF8              = ImageRule::OPTION_CAPTION_REJECT_INVALID_UTF8;
    const OPTION_CAPTION_STRIP_CONTROL_CHARACTERS         = ImageRule::OPTION_CAPTION_STRIP_CONTROL_CHARACTERS;
    const OPTION_CAPTION_STRIP_DIRECTION_OVERRIDES        = ImageRule::OPTION_CAPTION_STRIP_DIRECTION_OVERRIDES;
    const OPTION_CAPTION_STRIP_INVALID_UTF8               = ImageRule::OPTION_CAPTION_STRIP_INVALID_UTF8;
    const OPTION_CAPTION_STRIP_NULL_BYTES                 = ImageRule::OPTION_CAPTION_STRIP_NULL_BYTES;
    const OPTION_CAPTION_STRIP_ZERO_WIDTH_SPACE           = ImageRule::OPTION_CAPTION_STRIP_ZERO_WIDTH_SPACE;
    const OPTION_CAPTION_TRIM                             = ImageRule::OPTION_CAPTION_TRIM;

    // copyright options
    const OPTION_COPYRIGHT_ALLOW_CRLF                     = ImageRule::OPTION_COPYRIGHT_ALLOW_CRLF;
    const OPTION_COPYRIGHT_ALLOW_TAB                      = ImageRule::OPTION_COPYRIGHT_ALLOW_TAB;
    const OPTION_COPYRIGHT_MAX_LENGTH                     = ImageRule::OPTION_COPYRIGHT_MAX_LENGTH;
    const OPTION_COPYRIGHT_MIN_LENGTH                     = ImageRule::OPTION_COPYRIGHT_MIN_LENGTH;
    const OPTION_COPYRIGHT_NORMALIZE_NEWLINES             = ImageRule::OPTION_COPYRIGHT_NORMALIZE_NEWLINES;
    const OPTION_COPYRIGHT_REJECT_INVALID_UTF8            = ImageRule::OPTION_COPYRIGHT_REJECT_INVALID_UTF8;
    const OPTION_COPYRIGHT_STRIP_CONTROL_CHARACTERS       = ImageRule::OPTION_COPYRIGHT_STRIP_CONTROL_CHARACTERS;
    const OPTION_COPYRIGHT_STRIP_DIRECTION_OVERRIDES      = ImageRule::OPTION_COPYRIGHT_STRIP_DIRECTION_OVERRIDES;
    const OPTION_COPYRIGHT_STRIP_INVALID_UTF8             = ImageRule::OPTION_COPYRIGHT_STRIP_INVALID_UTF8;
    const OPTION_COPYRIGHT_STRIP_NULL_BYTES               = ImageRule::OPTION_COPYRIGHT_STRIP_NULL_BYTES;
    const OPTION_COPYRIGHT_STRIP_ZERO_WIDTH_SPACE         = ImageRule::OPTION_COPYRIGHT_STRIP_ZERO_WIDTH_SPACE;
    const OPTION_COPYRIGHT_TRIM                           = ImageRule::OPTION_COPYRIGHT_TRIM;

    // source options
    const OPTION_SOURCE_ALLOW_CRLF                        = ImageRule::OPTION_SOURCE_ALLOW_CRLF;
    const OPTION_SOURCE_ALLOW_TAB                         = ImageRule::OPTION_SOURCE_ALLOW_TAB;
    const OPTION_SOURCE_MAX_LENGTH                        = ImageRule::OPTION_SOURCE_MAX_LENGTH;
    const OPTION_SOURCE_MIN_LENGTH                        = ImageRule::OPTION_SOURCE_MIN_LENGTH;
    const OPTION_SOURCE_NORMALIZE_NEWLINES                = ImageRule::OPTION_SOURCE_NORMALIZE_NEWLINES;
    const OPTION_SOURCE_REJECT_INVALID_UTF8               = ImageRule::OPTION_SOURCE_REJECT_INVALID_UTF8;
    const OPTION_SOURCE_STRIP_CONTROL_CHARACTERS          = ImageRule::OPTION_SOURCE_STRIP_CONTROL_CHARACTERS;
    const OPTION_SOURCE_STRIP_DIRECTION_OVERRIDES         = ImageRule::OPTION_SOURCE_STRIP_DIRECTION_OVERRIDES;
    const OPTION_SOURCE_STRIP_INVALID_UTF8                = ImageRule::OPTION_SOURCE_STRIP_INVALID_UTF8;
    const OPTION_SOURCE_STRIP_NULL_BYTES                  = ImageRule::OPTION_SOURCE_STRIP_NULL_BYTES;
    const OPTION_SOURCE_STRIP_ZERO_WIDTH_SPACE            = ImageRule::OPTION_SOURCE_STRIP_ZERO_WIDTH_SPACE;
    const OPTION_SOURCE_TRIM                              = ImageRule::OPTION_SOURCE_TRIM;

    protected function buildValidationRules()
    {
        $rules = new RuleList();

        $options = $this->getOptions();

        $rules->push(new ImageRule('valid-image', $options));

        return $rules;
    }

    /**
     * Returns the property name that is used to store a file identifier.
     *
     * This property may be used for input field names in HTML and should then
     * be used in the file metadata value object as a property name for storing
     * a relative file path or similar.
     *
     * @return string property name
     */
    public function getFileLocationPropertyName()
    {
        return Image::PROPERTY_LOCATION;
    }

    /**
     * @return string type identifier of file type handled by the attribute
     */
    public function getFiletypeName()
    {
        return self::FILETYPE_IMAGE;
    }
}
