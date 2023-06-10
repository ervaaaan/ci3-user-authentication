<?php include_once(BASEPATH."helpers/form_helper.php");

/**
 * @author		Jack Devians
 * @copyright	Merlinbox Digital Solution
 * @link		https://merlinbox.com
*/

// ------------------------------------------------------------------------
function dateId($date){
    if($date != '0000-00-00'){
        $date = explode('-', $date);

        $data = $date[2] . ' ' . bulan($date[1]) . ', '. $date[0];
    }else{
        $data = 'Format tanggal salah';
    }

    return $data;
}

// ------------------------------------------------------------------------
function bulan($bln) {
    $bulan = $bln;

    switch ($bulan) {
        case 1:
            $bulan = "Januari";
            break;
        case 2:
            $bulan = "Februari";
            break;
        case 3:
            $bulan = "Maret";
            break;
        case 4:
            $bulan = "April";
            break;
        case 5:
            $bulan = "Mei";
            break;
        case 6:
            $bulan = "Juni";
            break;
        case 7:
            $bulan = "Juli";
            break;
        case 8:
            $bulan = "Agustus";
            break;
        case 9:
            $bulan = "September";
            break;
        case 10:
            $bulan = "Oktober";
            break;
        case 11:
            $bulan = "November";
            break;
        case 12:
            $bulan = "Desember";
            break;
    }
    return $bulan;
}

// ------------------------------------------------------------------------
if ( ! function_exists('terbilang')) {
    function terbilang($nilai) {
        if($nilai<0) {
            $hasil = "minus ". trim(penyebut($nilai));
        } else {
            $hasil = trim(penyebut($nilai));
        }     		
        return $hasil;
    }
    
    function penyebut($nilai) {
		$nilai = abs($nilai);
		$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = penyebut($nilai - 10). " belas";
		} else if ($nilai < 100) {
			$temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " seratus" . penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " seribu" . penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
		}     
		return $temp;
	}
}

// ------------------------------------------------------------------------
if ( ! function_exists('terbilang_harga')) {
    /**
     * Url Input Field
     *
     * @access  public
     * @param   mixed
     * @param   string
     * @param   string
     * @return  string
     */
    function terbilang_harga($harga) {
        if($harga < 999999999) {
            $res = round($harga/1000000, 2) . 'JT'; 
        } 
        elseif($harga < 999999999999) {
            $res = round($harga/1000000000, 2) . 'M'; 
        } 
        elseif($harga < 99999999999999){
            $res = round($harga/1000000000000, 2) . 'T'; 
        }
        return $res;
    }
}

// ------------------------------------------------------------------------
if ( ! function_exists('form_email')) {
    /**
     * Email Input Field
     *
     * @access	public
     * @param	mixed
     * @param	string
     * @param	string
     * @return	string
    */
	function form_email($data = '', $value = '', $extra = '') {
		$defaults = array('type' => 'email', 'name' => (( ! is_array($data)) ? $data : ''), 'value' => $value);
		return "<input "._parse_form_attributes($data, $defaults).$extra." />";
	}
}

// ------------------------------------------------------------------------
if ( ! function_exists('form_number')) {
    /**
     * Number Input Field
     *
     * @access	public
     * @param	mixed
     * @param	string
     * @param	string
     * @return	string
     */
	function form_number($data = '', $value = '', $extra = '') {
		$defaults = array('type' => 'number', 'name' => (( ! is_array($data)) ? $data : ''), 'value' => $value);
		return "<input "._parse_form_attributes($data, $defaults).$extra." />";
	}
}

// ------------------------------------------------------------------------
if ( ! function_exists('form_url')) {
    /**
     * Url Input Field
     *
     * @access	public
     * @param	mixed
     * @param	string
     * @param	string
     * @return	string
     */
	function form_url($data = '', $value = '', $extra = '') {
		$defaults = array('type' => 'url', 'name' => (( ! is_array($data)) ? $data : ''), 'value' => $value);
		return "<input "._parse_form_attributes($data, $defaults).$extra." />";
	}
}

// ------------------------------------------------------------------------
if ( ! function_exists('form_select')) {
    /**
     * Drop-down Menu
     *
     * @param   mixed   $data
     * @param   mixed   $options
     * @param   mixed   $selected
     * @param   mixed   $extra
     * @param   mixed   $attr
     * @return  string
     */

    function form_select($data = '', $options = array(), $selected = array(), $extra = '', $attr = array()) {
        $defaults = array();
        if (is_array($data)) {
            if (isset($data['selected'])) {
                $selected = $data['selected'];
                unset($data['selected']); // select tags don't have a selected attribute
            }

            if (isset($data['options'])) {
                $options = $data['options'];
                unset($data['options']); // select tags don't use an options attribute
            }
        }
        else {
            $defaults = array('name' => $data);
        }

        is_array($selected) OR $selected = array($selected);
        is_array($options) OR $options = array($options);

        // If no selected state was submitted we will attempt to set it automatically
        if (empty($selected)) {
            if (is_array($data)) {
                if (isset($data['name'], $_POST[$data['name']])) {
                    $selected = array($_POST[$data['name']]);
                }
            }
            elseif (isset($_POST[$data])) {
                $selected = array($_POST[$data]);
            }
        }

        $extra = _attributes_to_string($extra);

        $multiple = (count($selected) > 1 && strpos($extra, 'multiple') === FALSE) ? ' multiple="multiple"' : '';

        $form = '<select '.rtrim(_parse_form_attributes($data, $defaults)).$extra.$multiple.">\n";

        foreach ($options as $key => $val) {
            $attr_html = '';
            $key = (string) $key;

            if (is_array($val) && $key == 'optgroup') {
                if (empty($val)) {
                    continue;
                }

                $form .= '<optgroup label="'.$val['lable']."\">\n";

                foreach ($val as $optgroup_key => $optgroup_val) {
                    $sel = in_array($optgroup_key, $selected) ? ' selected="selected"' : '';
                    $form .= '<option value="'.html_escape($optgroup_key).'"'.$sel
                        .$attr_html.'>'
                        .(string) $optgroup_val."</option>\n";
                }
                $form .= "</optgroup>\n";
            }
            else {
                //manage options attributes
                if (array_key_exists($key,$attr)) {
                    if (is_array($attr[$key])) {
                        foreach ($attr[$key] as $attr_name => $attr_value) {
                            $attr_html .= ' '.html_escape($attr_name) .'="'.(string)$attr_value.'"'.' ';
                        }
                    }
                    else {
                        $attr_html = $attr[$key];
                    }
                }
                $form .= '<option value="'.html_escape($key).'"'
                    .(in_array($key, $selected) ? ' selected="selected"' : '')
                    .$attr_html.'>'
                    .(string) $val."</option>\n";
            }
        }

        return $form."</select>\n";
    }
}

/* End of file my_form_helper.php */
/* Location: ./application/helpers/my_form_helper.php */