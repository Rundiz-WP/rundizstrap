/**
 * Bootstrap search block edit component.
 * 
 * @package bootstrap-basic-fse
 * @since 0.0.1
 * @author Vee W.
 */


/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * Imports the InspectorControls component, which is used to wrap
 * the block's custom controls that will appear in in the Settings
 * Sidebar when the block is selected.
 *
 * Also imports the React hook that is used to mark the block wrapper
 * element. It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#inspectorcontrols
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import {
    InspectorControls, 
    useBlockProps, 
    RichText, 
} from '@wordpress/block-editor';

/**
 * Element is a package that builds on top of React and provide a set of utilities to work with React components and React elements.
 * 
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-element/
 */
import { useEffect, useRef } from '@wordpress/element';

/**
 * Imports the necessary components that will be used to create
 * the user interface for the block's settings.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/components/text-control/
 * @see https://developer.wordpress.org/block-editor/reference-guides/components/toggle-control/
 */
import {
    SelectControl, 
    TextControl, 
    ToggleControl, 
    __experimentalToolsPanel as ToolsPanel,
    __experimentalToolsPanelItem as ToolsPanelItem,
} from '@wordpress/components';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @param {Object} props Properties passed to the function.
 * @param {Object} props.attributes Available block attributes.
 * @param {Function} props.setAttributes Function that updates individual attributes.
 * @return {Element} Element to render.
 */
export default function Edit({attributes, setAttributes}) {
    const {
        showLabel,
        label,
        buttonPosition,
        buttonClass,
        buttonText,
        placeholderText,
    } = attributes;

    useEffect(() => {
        if (!attributes.buttonClass) {
            setAttributes({buttonClass: 'btn btn-primary'});
        }
        if (!attributes.label) {
            setAttributes({label: __('Search', 'bootstrap-basic-fse')});
        }
        if (!attributes.buttonText) {
            setAttributes({buttonText: __('Search', 'bootstrap-basic-fse')});
        }
    }, []);

    const searchFieldRef = useRef();
    const buttonRef = useRef();
    const buttonPositionControls = [
        {
            label: __('Button outside', 'bootstrap-basic-fse'),
            value: 'button-outside',
        },
        {
            label: __('Button group with input', 'bootstrap-basic-fse'),
            value: 'button-group-input',
        },
        {
            label: __('No button', 'bootstrap-basic-fse'),
            value: 'no-button',
        },
    ];
    const buttonDefaultPosition = 'button-outside';
    const buttonDefaultClass = 'btn btn-primary';

    // controls has been copied from WordPress core search block.
    const controls = (
        <>
            <InspectorControls>
                <ToolsPanel
                    label={__('Settings', 'bootstrap-basic-fse')}
                    resetAll={() => {
                        setAttributes({
                            showLabel: false,
                            buttonPosition: buttonDefaultPosition,
                        });
                    }}
                >
                    <ToolsPanelItem
                        hasValue={() => showLabel}
                        label={__('Show label', 'bootstrap-basic-fse')}
                        onDeselect={() => {
                            setAttributes({
                                showLabel: false,
                            });
                        }}
                        isShownByDefault
                    >
                        <ToggleControl
                            checked={showLabel}
                            label={__('Show label', 'bootstrap-basic-fse')}
                            onChange={ (value) =>
                                setAttributes({
                                    showLabel: value,
                                })
                            }
                        />
                    </ToolsPanelItem>
                    <ToolsPanelItem
                        hasValue={() => buttonPosition !== buttonDefaultPosition}
                        label={__('Button position', 'bootstrap-basic-fse')}
                        onDeselect={() => {
                            setAttributes({
                                buttonPosition: buttonDefaultPosition,
                            });
                        }}
                        isShownByDefault
                    >
                        <SelectControl
                            value={buttonPosition}
                            __next40pxDefaultSize
                            label={__('Button position', 'bootstrap-basic-fse')}
                            onChange={(value) => {
                                setAttributes({
                                    buttonPosition: value,
                                });
                            }}
                            options={buttonPositionControls}
                        />
                    </ToolsPanelItem>
                    {('no-button' !== buttonPosition) && (
                        <ToolsPanelItem
                            hasValue={() => buttonClass !== buttonDefaultClass}
                            label={__('Button class', 'bootstrap-basic-fse')}
                            onDeselect={() => {
                                setAttributes({
                                    buttonClass: buttonDefaultClass,
                                });
                            }}
                            isShownByDefault
                        >
                            <TextControl
                                label={__('Button classes', 'bootstrap-basic-fse')}
                                value={buttonClass}
                                onChange={
                                    (buttonClass) => setAttributes({buttonClass})
                                }
                            />
                        </ToolsPanelItem>
                    )}
                </ToolsPanel>
            </InspectorControls>
        </>
    );// end const controls

    // render text field has been copied from WordPress core search block.
    const renderTextField = () => {
        return (
            <input
                type="search"
                className="form-control"
                aria-label={__('Optional placeholder text', 'bootstrap-basic-fse')}
                placeholder={
                    placeholderText ? undefined : __('Optional placeholder…', 'bootstrap-basic-fse')
                }
                value={placeholderText}
                onChange={(event) =>
                    setAttributes({placeholderText: event.target.value})
                }
                ref={searchFieldRef}
            />
        );
    };// end const renderTextField()

    // render button has been copied from WordPress core search block.
    const renderButton = () => {
        let buttonClasses = buttonDefaultClass;
        if (buttonClass) {
            buttonClasses = buttonClass;
        }

        return (
            <>
                <RichText
                    identifier="buttonText"
                    className={buttonClasses}
                    aria-label={__('Button text', 'bootstrap-basic-fse')}
                    placeholder={__('Add button text…', 'bootstrap-basic-fse')}
                    withoutInteractiveFormatting
                    value={buttonText}
                    onChange={(html) =>
                        setAttributes({buttonText: html})
                    }
                    ref={buttonRef}
                />
            </>
        );
    };// end const renderButton()

    return (
        <div { ...useBlockProps() }>
            {controls}
            {showLabel && (
                <>
                    <div class="row">
                        <div class="col-12">
                            <RichText
                                identifier="label"
                                aria-label={__('Label text', 'bootstrap-basic-fse')}
                                placeholder={__('Add label…', 'bootstrap-basic-fse')}
                                withoutInteractiveFormatting
                                value={label}
                                onChange={(html) => setAttributes({label: html})}
                            />
                        </div>
                    </div>
                </>
            )}
            {('button-group-input' === buttonPosition) ? (
                <>
                    <div class="input-group">
                        {renderTextField()}
                        {renderButton()}
                    </div>
                </>
            ) : (
                <>
                    <div class="row g-0">
                        <div
                            className={'no-button' === buttonPosition ? 'col-12' : 'col-auto me-auto'}
                        >
                            {renderTextField()}
                        </div>
                        {('no-button' !== buttonPosition) && (
                            <>
                                <div class="col-auto">
                                    {renderButton()}
                                </div>
                            </>
                        )}
                    </div>
                </>
            )}
        </div>
    );
}// end export;