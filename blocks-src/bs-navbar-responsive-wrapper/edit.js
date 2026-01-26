/**
 * Bootstrap navbar responsive wrapper block edit component.
 * 
 * @package bootstrap-basic-fse
 * @since 0.0.1
 * @author Vee W.
 */

import { sprintf, __ } from '@wordpress/i18n';

import { useBlockProps, InnerBlocks, InspectorControls, useInnerBlocksProps } from '@wordpress/block-editor';

import {
    PanelBody,
    SelectControl,
    TextControl,
    Button,
    Icon,
    __experimentalToolsPanel as ToolsPanel,
    __experimentalToolsPanelItem as ToolsPanelItem
} from '@wordpress/components';

import { useState, useEffect } from '@wordpress/element';

/**
 * Key-Value input control.
 */
const KeyValueControl = ({ label, value, onChange }) => {
    // Ensure value is an object
    const attributes = value || {};
    const [localAttributes, setLocalAttributes] = useState([]);

    useEffect(() => {
        // Convert object to array for editing
        const attrsArray = Object.entries(attributes).map(([key, val]) => ({ key, val }));
        setLocalAttributes(attrsArray);
    }, [value]);

    const updateAttribute = (index, field, newValue) => {
        const newAttributes = [...localAttributes];
        newAttributes[index][field] = newValue;
        setLocalAttributes(newAttributes);

        // Check for duplicate keys
        const keys = newAttributes.map(attr => attr.key);
        const hasDuplicates = keys.some((key, i) => keys.indexOf(key) !== i);

        if (!hasDuplicates) {
            const attrObject = newAttributes.reduce((obj, item) => {
                if (item.key) obj[item.key] = item.val;
                return obj;
            }, {});
            onChange(attrObject);
        }
    };

    const addAttribute = () => {
        const newAttributes = [...localAttributes, { key: '', val: '' }];
        setLocalAttributes(newAttributes);
    };

    const removeAttribute = (index) => {
        const newAttributes = localAttributes.filter((_, i) => i !== index);
        setLocalAttributes(newAttributes);
        const attrObject = newAttributes.reduce((obj, item) => {
            if (item.key) obj[item.key] = item.val;
            return obj;
        }, {});
        onChange(attrObject);
    };

    return (
        <div className="components-base-control">
            <label className="components-base-control__label">{label}</label>
            {localAttributes.map((attr, index) => (
                <div key={index} style={{ display: 'flex', marginBottom: '5px', gap: '5px' }}>
                    <TextControl
                        placeholder={__('Key', 'bootstrap-basic-fse')}
                        value={attr.key}
                        onChange={(val) => updateAttribute(index, 'key', val)}
                    />
                    <TextControl
                        placeholder={__('Value', 'bootstrap-basic-fse')}
                        value={attr.val}
                        onChange={(val) => updateAttribute(index, 'val', val)}
                    />
                    <Button
                        isSmall
                        isDestructive
                        variant="secondary"
                        icon="trash"
                        onClick={() => removeAttribute(index)}
                        label={__('Remove', 'bootstrap-basic-fse')}
                    />
                </div>
            ))}
            <Button variant="secondary" onClick={addAttribute} isSmall>
                {__('Add attribute', 'bootstrap-basic-fse')}
            </Button>
        </div>
    );
};

export default function Edit({ attributes, setAttributes }) {
    const {
        wrapperStyle,
        dataAttributes,
        ariaAttributes,
        // offcanvas settings --------
        offcanvasHeaderClassName,
        offcanvasHeaderTitleIDName,
        offcanvasHeaderTitleClassName,
        offcanvasHeaderTitleText,
        // offcanvas header close button ---------
        offcanvasHeaderCloseBtnClassName,
        offcanvasHeaderCloseBtnDataAttributes,
        offcanvasHeaderCloseBtnAriaAttributes,
        // offcanvas body ----------
        offcanvasBodyClassName,
    } = attributes;

    const wrapperDefaultStyle = 'collapse';
    const offcanvasHeaderDefaultClassName = 'offcanvas-header';
    const offcanvasHeaderTitleDefaultIDName = '';
    const offcanvasHeaderTitleDefaultClassName = 'offcanvas-title';
    const offcanvasHeaderTitleDefaultText = '';
    const offcanvasHeaderCloseBtnDefaultClassName = '';
    const offcanvasBodyDefaultClassName = 'offcanvas-body';

    // Dynamically build class names based on wrapperStyle
    const getWrapperClasses = () => {
        if (wrapperStyle === 'offcanvas') {
            return 'offcanvas offcanvas-end';
        }
        // default = collapse
        return 'collapse navbar-collapse';
    };

    // Additional props only for offcanvas
    const extraProps = wrapperStyle === 'offcanvas' 
        ? { tabIndex: '-1' } 
        : {};

    const blockProps = useBlockProps({
        //className: getWrapperClasses(),// do not show styles on preview otherwise it can't edit the navigation menu inside it.
        ...extraProps,
    });

    const innerBlocksProps = useInnerBlocksProps({});

    // Helper to check if objects are empty
    const isObjectEmpty = (obj) => Object.keys(obj || {}).length === 0;

    return (
        <>
            <InspectorControls>
                {/* PanelBody provides the collapsible toggle */}
                <PanelBody 
                    title={ __( 'Navbar responsive wrapper Settings', 'textdomain' ) } 
                    initialOpen={ true }
                >
                    {/* ToolsPanel provides the reset functionality */}
                    <ToolsPanel
                        label={__('Navbar responsive wrapper', 'bootstrap-basic-fse')}
                        resetAll={() => setAttributes({
                            wrapperStyle: wrapperDefaultStyle,
                            dataAttributes: {},
                            ariaAttributes: {}
                        })}
                        style={{paddingLeft: '0px', paddingRight: '0px'}}
                    >
                        <div style={{color: 'rgb(117,117,117)', fontSize: '12px', gridColumn: '1 / -1', padding: '0px'}}>
                            <p>
                                {__('Please note that the preview will not display with styles so that editing can work.', 'bootstrap-basic-fse')}
                            </p>
                        </div>
                        <ToolsPanelItem
                            hasValue={() => wrapperStyle !== wrapperDefaultStyle}
                            label={__('Wrapper style', 'bootstrap-basic-fse')}
                            onDeselect={() => setAttributes({ wrapperStyle: wrapperDefaultStyle })}
                            isShownByDefault
                        >
                            <SelectControl
                                label={__('Wrapper style', 'bootstrap-basic-fse')}
                                value={wrapperStyle}
                                options={[
                                    { label: 'collapse', value: 'collapse' },
                                    { label: 'offcanvas', value: 'offcanvas' },
                                ]}
                                onChange={(value) => setAttributes({ wrapperStyle: value })}
                            />
                        </ToolsPanelItem>
                        <ToolsPanelItem
                            hasValue={() => !isObjectEmpty(dataAttributes)}
                            label={__('Data attributes', 'bootstrap-basic-fse')}
                            onDeselect={() => setAttributes({ dataAttributes: {} })}
                            isShownByDefault
                        >
                            <KeyValueControl
                                label={__('Data attributes', 'bootstrap-basic-fse') + ' '}
                                value={dataAttributes}
                                onChange={(value) => setAttributes({ dataAttributes: value })}
                            />
                        </ToolsPanelItem>
                        <ToolsPanelItem
                            hasValue={() => !isObjectEmpty(ariaAttributes)}
                            label={__('Aria attributes', 'bootstrap-basic-fse')}
                            onDeselect={() => setAttributes({ ariaAttributes: {} })}
                            isShownByDefault
                        >
                            <KeyValueControl
                                label={__('Aria attributes', 'bootstrap-basic-fse') + ' '}
                                value={ariaAttributes}
                                onChange={(value) => setAttributes({ ariaAttributes: value })}
                            />
                        </ToolsPanelItem>
                    </ToolsPanel>
                </PanelBody>
                {('offcanvas' === wrapperStyle) && (
                    <>
                        <PanelBody 
                            title={ __( 'Offcanvas Settings', 'textdomain' ) } 
                        >
                            <ToolsPanel
                                label={__('Navbar responsive offcanvas', 'bootstrap-basic-fse')}
                                resetAll={() => setAttributes({
                                    offcanvasHeaderClassName: offcanvasHeaderDefaultClassName,
                                    offcanvasHeaderTitleIDName: offcanvasHeaderTitleDefaultIDName,
                                    offcanvasHeaderTitleClassName: offcanvasHeaderTitleDefaultClassName,
                                    offcanvasHeaderTitleText: offcanvasHeaderTitleDefaultText,
                                    offcanvasHeaderCloseBtnClassName: offcanvasHeaderCloseBtnDefaultClassName,
                                    offcanvasHeaderCloseBtnDataAttributes: {},
                                    offcanvasHeaderCloseBtnAriaAttributes: {},
                                    offcanvasBodyClassName: offcanvasBodyDefaultClassName,
                                })}
                            >
                                <ToolsPanelItem
                                    hasValue={() => offcanvasHeaderClassName !== offcanvasHeaderDefaultClassName}
                                    label={__('Offcanvas header Class', 'bootstrap-basic-fse')}
                                    onDeselect={() => setAttributes({ offcanvasHeaderClassName: offcanvasHeaderDefaultClassName })}
                                    isShownByDefault
                                >
                                    <TextControl
                                        label={__('Offcanvas header Class', 'bootstrap-basic-fse')}
                                        value={offcanvasHeaderClassName}
                                        onChange={(value) => setAttributes({ offcanvasHeaderClassName: value })}
                                        help={sprintf(
                                            __('Default is %1$s.', 'bootstrap-basic-fse'),
                                            offcanvasHeaderDefaultClassName
                                        )}
                                    />
                                </ToolsPanelItem>
                                <ToolsPanelItem
                                    hasValue={() => offcanvasHeaderTitleIDName !== offcanvasHeaderTitleDefaultIDName}
                                    label={__('Offcanvas header title ID', 'bootstrap-basic-fse')}
                                    onDeselect={() => setAttributes({ offcanvasHeaderTitleIDName: offcanvasHeaderTitleDefaultIDName })}
                                    isShownByDefault
                                >
                                    <TextControl
                                        label={__('Offcanvas header title ID', 'bootstrap-basic-fse')}
                                        value={offcanvasHeaderTitleIDName}
                                        onChange={(value) => {
                                            // Real-time sanitization on every keystroke
                                            let sanitized = value
                                                .replace(/\s+/g, '-') // replace any spaces with single dash
                                                .replace(/[^a-z0-9_-]/g, ''); // remove all invalid chars (keep only a-z, 0-9, -, _)

                                            // Optional: ensure it starts with a letter, -, or _ (HTML5 allows digit start, but stricter is safer)
                                            // if (sanitized && !/^[a-z_-]/.test(sanitized)) {
                                            //     sanitized = sanitized.replace(/^[^a-z_-]+/, '');
                                            // }

                                            setAttributes({ offcanvasHeaderTitleIDName: sanitized });
                                        }}
                                        help={__('HTML id attribute on offcanvas header title', 'bootstrap-basic-fse')}
                                    />
                                </ToolsPanelItem>
                                <ToolsPanelItem
                                    hasValue={() => offcanvasHeaderTitleClassName !== offcanvasHeaderTitleDefaultClassName}
                                    label={__('Offcanvas header title Class', 'bootstrap-basic-fse')}
                                    onDeselect={() => setAttributes({ offcanvasHeaderTitleClassName: offcanvasHeaderTitleDefaultClassName })}
                                    isShownByDefault
                                >
                                    <TextControl
                                        label={__('Offcanvas header title Class', 'bootstrap-basic-fse')}
                                        value={offcanvasHeaderTitleClassName}
                                        onChange={(value) => setAttributes({ offcanvasHeaderTitleClassName: value })}
                                        help={sprintf(
                                            __('Default is %1$s.', 'bootstrap-basic-fse'),
                                            offcanvasHeaderTitleDefaultClassName
                                        )}
                                    />
                                </ToolsPanelItem>
                                <ToolsPanelItem
                                    hasValue={() => offcanvasHeaderTitleText !== offcanvasHeaderTitleDefaultText}
                                    label={__('Offcanvas header title text', 'bootstrap-basic-fse')}
                                    onDeselect={() => setAttributes({ offcanvasHeaderTitleText: offcanvasHeaderTitleDefaultText })}
                                    isShownByDefault
                                >
                                    <TextControl
                                        label={__('Offcanvas header title text', 'bootstrap-basic-fse')}
                                        value={offcanvasHeaderTitleText}
                                        onChange={(value) => setAttributes({ offcanvasHeaderTitleText: value })}
                                        help={__('You can use text or HTML. This will be display inside offcanvas title.', 'bootstrap-basic-fse')}
                                    />
                                </ToolsPanelItem>
                                <ToolsPanelItem
                                    hasValue={() => offcanvasHeaderCloseBtnClassName !== offcanvasHeaderCloseBtnDefaultClassName}
                                    label={__('Close button additional Class', 'bootstrap-basic-fse')}
                                    onDeselect={() => setAttributes({ offcanvasHeaderCloseBtnClassName: offcanvasHeaderCloseBtnDefaultClassName })}
                                    isShownByDefault
                                >
                                    <TextControl
                                        label={__('Close button additional Class', 'bootstrap-basic-fse')}
                                        value={offcanvasHeaderCloseBtnClassName}
                                        onChange={(value) => setAttributes({ offcanvasHeaderCloseBtnClassName: value })}
                                        help={__('This will be additional class next to main close button class.', 'bootstrap-basic-fse')}
                                    />
                                </ToolsPanelItem>
                                <ToolsPanelItem
                                    hasValue={() => !isObjectEmpty(offcanvasHeaderCloseBtnDataAttributes)}
                                    label={__('Close button data attributes', 'bootstrap-basic-fse')}
                                    onDeselect={() => setAttributes({ offcanvasHeaderCloseBtnDataAttributes: {} })}
                                    isShownByDefault
                                >
                                    <KeyValueControl
                                        label={__('Close button data attributes', 'bootstrap-basic-fse') + ' '}
                                        value={offcanvasHeaderCloseBtnDataAttributes}
                                        onChange={(value) => setAttributes({ offcanvasHeaderCloseBtnDataAttributes: value })}
                                    />
                                </ToolsPanelItem>
                                <ToolsPanelItem
                                    hasValue={() => !isObjectEmpty(offcanvasHeaderCloseBtnAriaAttributes)}
                                    label={__('Close button aria attributes', 'bootstrap-basic-fse')}
                                    onDeselect={() => setAttributes({ offcanvasHeaderCloseBtnAriaAttributes: {} })}
                                    isShownByDefault
                                >
                                    <KeyValueControl
                                        label={__('Close button aria attributes', 'bootstrap-basic-fse') + ' '}
                                        value={offcanvasHeaderCloseBtnAriaAttributes}
                                        onChange={(value) => setAttributes({ offcanvasHeaderCloseBtnAriaAttributes: value })}
                                    />
                                </ToolsPanelItem>
                                <ToolsPanelItem
                                    hasValue={() => offcanvasBodyClassName !== offcanvasBodyDefaultClassName}
                                    label={__('Offcanvas body Class', 'bootstrap-basic-fse')}
                                    onDeselect={() => setAttributes({ offcanvasBodyClassName: offcanvasBodyDefaultClassName })}
                                    isShownByDefault
                                >
                                    <TextControl
                                        label={__('Offcanvas body Class', 'bootstrap-basic-fse')}
                                        value={offcanvasBodyClassName}
                                        onChange={(value) => setAttributes({ offcanvasBodyClassName: value })}
                                        help={sprintf(
                                            __('Default is %1$s.', 'bootstrap-basic-fse'),
                                            offcanvasBodyDefaultClassName
                                        )}
                                    />
                                </ToolsPanelItem>
                            </ToolsPanel>
                        </PanelBody>
                    </>
                )}
            </InspectorControls>

            <div {...blockProps}>
                <InnerBlocks />
            </div>
        </>
    );
}
