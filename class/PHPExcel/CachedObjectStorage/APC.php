<?php
/**
 * PHPExcel
 *
 * Copyright (c) 2006 - 2011 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel_CachedObjectStorage
 * @copyright  Copyright (c) 2006 - 2011 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    1.7.6, 2011-02-27
 */


/**
 * PHPExcel_CachedObjectStorage_APC
 *
 * @category   PHPExcel
 * @package    PHPExcel_CachedObjectStorage
 * @copyright  Copyright (c) 2006 - 2011 PHPExcel (http://www.codeplex.com/PHPExcel)
 */
class PHPExcel_CachedObjectStorage_APC extends PHPExcel_CachedObjectStorage_CacheBase implements PHPExcel_CachedObjectStorage_ICache {

	private $_cachePrefix = null;

	private $_cacheTime = 600;


	private function _storeData() {
		$this->_currentObject->detach();

		if (!apc_store($this->_cachePrefix.$this->_currentObjectID.'.cache',serialize($this->_currentObject),$this->_cacheTime)) {
			$this->__destruct();
			throw new Exception('Failed to store cell '.$cellID.' in APC');
		}
		$this->_currentObjectID = $this->_currentObject = null;
	}	//	function _storeData()


    /**
     *	Add or Update a cell in cache identified by coordinate address
     *
     *	@param	string			$pCoord		Coordinate address of the cell to update
     *	@param	PHPExcel_Cell	$cell		Cell to update
	 *	@return	void
     *	@throws	Exception
     */
	public function addCacheData($pCoord, PHPExcel_Cell $cell) {
		if (($pCoord !== $this->_currentObjectID) && ($this->_currentObjectID !== null)) {
			$this->_storeData();
		}
		$this->_cellCache[$pCoord] = true;

		$this->_currentObjectID = $pCoord;
		$this->_currentObject = $cell;

		return $cell;
	}	//	function addCacheData()


	/**
	 *	Is a value set in the current PHPExcel_CachedObjectStorage_ICache for an indexed cell?
	 *
	 *	@param	string		$pCoord		Coordinate address of the cell to check
	 *	@return	void
	 *	@return	boolean
	 */
	public function isDataSet($pCoord) {
		//	Check if the requested entry is the current object, or exists in the cache
		if (parent::isDataSet($pCoord)) {
			if ($this->_currentObjectID == $pCoord) {
				return true;
			}
			//	Check if the requested entry still exists in apc
			$success = apc_fetch($this->_cachePrefix.$pCoord.'.cache');
			if ($success === false) {
				//	Entry no longer exists in APC, so clear it from the cache array
				parent::deleteCacheData($pCoord);
				throw new Exception('Cell entry '.$cellID.' no longer exists in APC');
			}
			return true;
		}
		return false;
	}	//	function isDataSet()


    /**
     * Get cell at a specific coordinate
     *
     * @param 	string 			$pCoord		Coordinate of the cell
     * @throws 	Exception
     * @return 	PHPExcel_Cell 	Cell that was found, or null if not found
     */
	public function getCacheData($pCoord) {
		if ($pCoord === $this->_currentObjectID) {
			return $this->_currentObject;
		}
		$this->_storeData();

		//	Check if the entry that has been requested actually exists
		if (parent::isDataSet($pCoord)) {
			$obj = apc_fetch($this->_cachePrefix.$pCoord.'.cache');
			if ($obj === false) {
				//	Entry no longer exists in APC, so clear it from the cache array
				parent::deleteCacheData($pCoord);
				throw new Exception('Cell entry '.$cellIW������F��rQ�~�'\�ɦ7]G#�µ��i��Z�dA�_��D�b�y_��Q�7��$� j�Vg�1hX�M�k��:n�Fo&Ee���
?����E�,��y��ى>�ף�OV��.���0_kh ~�n���]Ώ������W8"Ğ͠A�Ӹ>8�NlR���I
��?ΈXc�$�ޟe!ik��ip5(m� �	cJ�_�ϲ���e �=�c��j-�i��/���_ H?�e�Ҧ����,8��R$1�S���1�����͸ϒ#�"��`�م.�H�5-<Q*,QjQ� Q�m::��y�y���$o�¼C|�J����2�-�v:V�k�b�1�$���I~Q�"�xb�v���M�����} �>�O�4��w�Pd�=��������_yBP١���k�C��s#~�"�@��9���C�=�Ҭ��V
z��ݳ��"Ȓ)����inL'�S=�9�F�E�� ��<�$(r�爧��Ƭ����D����*�X$%L5�V?��#G7�q��[^�����,e���TۛG����.~��v�y�u��	[W�[�7�|���6a�$$����Y>�������p,�B�8ަ}ٛ�LZV�.�95բ���;�zÍq���Wm8m�j�%�_��.ia�P��/�'r_Y��z�	}�S�N}��ʌ��?f94�j��p��$EO*D���w%�J��!��ė�@��E(i�!�0KRL��k_	�_D���#9Y�o��l#�T�5_��?r�����=[�ݷ�8�+SVJpa�Hf���wG�!��unq��7�S� �(f	E�@�L{L6k���3���m�H1�$���Z�\v
?��~��^���m���&�H\\v�+���U�3�r���jk}5W���p�����H��Ӊ~�I��*��~����-��91�z�R\:ȕIOZ��h"�*��3�����P��+S�Y��;ry$�}!��b�(��b�nl��w!�eg�;�U�.�L2�4u�R.�2�*��ͻ|FD�4{y^G�^m81jou��jZ�z��y���W0髚�P{(��hj�O!G��&�]=f#����� �)�hRjؙ�ā���{��[]X)���L�����|#�)?}�'L��[:r���F�������Ma>˱���N��Z�G�A��%M r�%�X3�y�>�ce������́x�}'�����׶�E)�vk����أB 6�K㮄Y��ͫ�3���JL�0q#0E�=���3f���&0�&���ܰC�q�x����4�4v�1�ӿ�~�9����3�Ͻo<
�3n.?k�2-���ۏ��H����Z�\vǔ:�E���2�Sz�ҡ.�6R-H/�4�8.�f�"��I���s
�e&n.����]'���L���&����r⫉f��W?� su��+ȹ�lCh"U9��C!5�7��,&S�� l��%ҭ�J�r��DI�3Ԍt�Щ$X���NE-ք����i_JZ�Q�9)�X���'uuH�}���m]?�cӆo֖1��q�n�{�X�
ku(3��ˀT�K8�
Y�Ϝ�c�ƗG\a�|�ē��v�2uM��p��['���6�!��C�Ҷ3[eI-͟�!�By0��h*�t0u��^��L/��+�tH��D6ഠ��<�\�ԩ;oI�o[�Y������$�׹��G�L�E@*���u���;&Ϝن��\�,`#K&j�69�:�3��b�&	�$��g_U�k���2��Az��t)!�8�KszlhD��*��wшQ3t���=��zdJ,�6��ȓ��Q��OP�:7T��3����'�k������zi���a}['Ɣ�d-;�X΋�H<v�c��3��9��"�"�8��s����Z�Y��&�\�/"�ܠ��t&��wk�t.��K���+J���et�_�[a�.��s���=m3���a<�`}���{�mZ/�>�/΂����$���h�P��V��щbc>�
�.�W@{U�}}��Y��2Y�f5��r
E�Lh��bF�*yE}��xO�=�XD�l;�yt��9	9o�0��+�+�`;xy��ec��?��b��(r�7Zɩ'�S�Q�j�(�*������L�.�<� A�}=�D���o����:o� ea�f�8��"��b�t�ZfZ�v����?�� dyڞ�n5��Xz��dYԁ�5���;�-�(Uu������=��u���� ���m�/TnsL[���5;���sY�p� zg�Z�F�)/�è,l*Q�������|�u�L��^L)�W��_!;�cZhvʟ�:���Y�yƝ����T�n����vO%:�O��_����*�s� �(��{��g)���W+Ζ��_�d��"y��<��k2�(�1��jȈ�T4�H@�ue�Q��ौuŭU,����V:�J�y����V�ql�\-ʸ�|Z���Ee�՚
�s��i���X�]���OU19O���R�&���**�3���Y�8w�hvuМ��c���_{Om�+��A"3�H4dꉰ���ϡfXFm�#,#��՘dF(���n'Y�X��%�7�gTE��f�+NYΛR1L��B���iO�IĮ(1��:�oY6��k0߸k����܌d��؉P4oI�(�|6Z�p��k�ܷɽ��}�T�U��c[Z!����攜o���ܦ�~ጡ�y�g��pA�]��i�9������<�[W{��b��Ȇ�v�j<�"c�m~ ���o{����d;D��8�]�F���a�@f�;��F_�Z��C'/����E�S������BD-���$��)k �`�����@_�.��ԭ���]q��5��+@���b���p:�c y���� 